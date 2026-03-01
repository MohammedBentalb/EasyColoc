<?php

namespace App\Http\Controllers;

use App\ColocationStatus;
use App\Http\Requests\ColocationRequest;
use App\Http\Requests\InviteRequest;
use App\Mail\TokenEmail;
use App\Models\Category;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\Membership;
use App\Models\User;
use App\Services\JWTManager;
use App\UsersColectionRoles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Metadata\Api\Dependencies;

class ColocationController extends Controller {
    public function __construct(public JWTManager $JWTManager, public \App\Services\BalanceCalculator $balanceCalculator) {}

    public function home(Request $request) {
        $user = $request->user();
        $activeColocation = $user->getActiveColocation()->first();
        $inActiveColocations = $user->getInActiveColocations()->get();
        $activeUsers = $activeColocation?->users()->wherePivot('status', ColocationStatus::active->value)->count();
        return view('colocations.home', compact('activeColocation', 'inActiveColocations', 'user', 'activeUsers'));
    }

    public function index(Request $request, Colocation $colocation) {
        $user = $request->user();
        $users = $colocation->users;
        $role = $user->getActiveColocation()->first()->pivot->role;
        $activeUsers = $colocation->users()->wherePivot('status', ColocationStatus::active->value)->count();
        $colocationUsers = $colocation->users()->wherePivot('status', ColocationStatus::active->value)->get();
        
        $myBalanceData = $this->balanceCalculator->balance($user);
        $myBalance = $myBalanceData['solde'];
        $myTotalPaid = $myBalanceData['totalPaid'];

        foreach ($users as $roommate) {
            $roommateData = $this->balanceCalculator->balance($roommate);
            $roommate->calculated_balance = $roommateData['solde'];
        }

        return view('colocations.index', compact('user', 'colocation', 'users', 'role', 'activeUsers', 'myBalance', 'myTotalPaid', 'colocationUsers'));
    }

    public function store(ColocationRequest $request){
        $data = $request->validated(); 
        dd($data);       
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('uploads/colocations', 'public');
        $user = $request->user();
        $colocation = Colocation::create($data);
        $colocation->users()->attach($user->id, ['role' => UsersColectionRoles::owner, 'status' => ColocationStatus::active->value]);
        Category::create(['name' => 'default', 'colocation_id' => $colocation->id]);
        return redirect("/colocations/{$colocation->id}");
    }

    public function create(Request $request) {
        return view('colocations.create', ['user' => $request->user()]);
    }

    public function invite(InviteRequest $request, Colocation $colocation) {
        $data = $request->validated();
        $user = $request->user();
        $colocation = $user->getActiveColocation()->first();            
        $payload = ['colocation_id' => $colocation->id, 'email' => $data['email']];
        $token = $this->JWTManager->generate($payload, (new Carbon())->addDay()->timestamp);
        $url = url("/colocations/$token/add");
        Mail::to($data['email'])->send(new TokenEmail($url));
        return back()->with('success', 'email has been sent');
    }
    public function add(Request $request, string $token) {
        $payload = $this->JWTManager->decode($token);
        $colocation = Colocation::where('id', $payload->colocation_id)->first();
        $user = User::where('email', $payload->email)->first();
        $activeColection = $user->getActiveColocation()->first();
        if($activeColection) return redirect('/colocations/')->with(['success' => 'you are already in an active collection']);
        $membership = Membership::where('user_id', $user->id)->where('colocation_id', $colocation->id)->orderByDesc('updated_at')->first();

        if($membership){
            $membership->status = ColocationStatus::active;
            $membership->save();
            return redirect("/colocations")->with('success', "welcom to {$colocation->name}");
        }

        $user->colocations()->attach($colocation->id, ['role' => UsersColectionRoles::member->value, 'status' => ColocationStatus::active->value]);
        return redirect("/colocations")->with('success', "you have joined $colocation->name successfuly");

    }

    public function quite(Request $request, Colocation $colocation) {
        $user = $request->user();
        $membership = Membership::where('user_id', $user->id)->where('colocation_id', $colocation->id)->first();
        $activeColocation = $user->getActiveColocation()->first();
        if($colocation->id != $activeColocation->id ||  $membership->role == UsersColectionRoles::owner->value && $colocation->users()->wherePivot('status', ColocationStatus::active->value)->count() > 1) return back()->withErrors(['error' => "You can't leave untile the colocation is empty"]);
        
        $hasDebt = Depense::whereHas('category', function($q) use($colocation){
            $q->where('colocation_id', $colocation->id);
        })->whereDoesntHave('settlements', function($q) use($user){
            $q->where('user_id', $user->id);
        })->exists();

        if ($hasDebt) $user->decrement('reputation');
        if (!$hasDebt) $user->increment('reputation');

        $membership->status = ColocationStatus::inActive->value;
        $membership->save();
        return redirect('/colocations');
    }

    public function cancel(Request $request, Colocation $colocation) {
        $user = $request->user();
        $role = $user->getUserColocationRole();
        if($role != UsersColectionRoles::owner->value) return back()->withErrors('error', 'Action denied'); 
        
        $members = $colocation->users()->wherePivot('role', '!=', UsersColectionRoles::owner->value)->wherePivot('status', ColocationStatus::active->value)->get();
        foreach ($members as $member) {
            $hasDebt = Depense::whereHas('category', function($q) use($colocation){
                $q->where('colocation_id', $colocation->id);
            })->whereDoesntHave('settlements', function($q) use($member){
                $q->where('user_id', $member->id);
            })->exists();

            if ($hasDebt) $user->decrement('reputation');
            if ($hasDebt) $user->increment('reputation');
        }

        Membership::where('colocation_id', $colocation->id)->where('role', '!=', UsersColectionRoles::owner->value)->update(['status' => ColocationStatus::inActive->value]);
        return back()->with('success', 'all users have been removed');
    }
}
