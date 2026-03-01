<?php

namespace App\Http\Controllers;

use App\ColocationStatus;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\Membership;
use App\Models\Settlement;
use App\Models\User;
use App\UsersColectionRoles;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index() {
        $user = auth()->user();
        $users = User::all()->where('email', '!=', $user->email);
        $totalColocations = Colocation::count();
        $activeColocations = Colocation::whereHas('users')->count();

        return view('users.index', compact('users', 'totalColocations', 'activeColocations', 'user'));
    }

    public function fireRoommate(Request $request, Colocation $colocation, User $user){
        $owner = $request->user();
        if (!$owner || $owner->getUserColocationRole() !== UsersColectionRoles::owner->value) return back()->withErrors(['error' => 'Only the colocation owner can fire roommates']);
        
        $member = Membership::where('colocation_id', $colocation->id)->where('user_id', $user->id)->first();
        if (!$member) return back()->withErrors(['error' => 'User is not a member of this colocation']);
        if ($member->role === UsersColectionRoles::owner->value) return back()->withErrors(['error' => 'Cannot fire the owner']);
        
        $unpaidDepenses = Depense::whereHas('category', function($q) use($colocation){
            $q->where('colocation_id', $colocation->id);
        })->whereDoesntHave('settlements', function($q) use($user){
            $q->where('user_id', $user->id);
        })->get();

        if ($unpaidDepenses->count() > 0) {
            $user->decrement('reputation');
            
            $usersCount = $colocation->users()->count();
                foreach ($unpaidDepenses as $depense) {
                    $share = $depense->amount / $usersCount;
                    
                    Settlement::create([
                        'amount' => $share,
                        'depense_id' => $depense->id,
                        'user_id' => $owner->id
                    ]);

                    $totalSettled = $depense->settlements()->sum('amount');
                    if (abs($totalSettled - $depense->amount) < 0.01) {
                        $depense->update(['status' => \App\DepenseStatus::paid->value]);
                    }
                }
        } else {
            $user->increment('reputation');
        }

        $member->status = ColocationStatus::inActive->value;
        $member->save();
        return back()->with('success', "Roommate {$user->username} has been fired and balances adjusted.");
    }

    public function banUser(User $user){
        $user->banned = true;
        $user->save();
        return back()->with('success', "User {$user->username} has been banned");
    }

    public function unbanUser(User $user){
        $user->banned = false;
        $user->save();
        return back()->with('success', "User {$user->username} has been unbanned");
    }

    public function profile(Request $request) {
        $user = $request->user();
        $activeColocation = $user->getActiveColocation()->first();
        $pastColocationsCount = $user->colocations()->wherePivot('status', ColocationStatus::inActive->value)->count();

        return view('users.profile', compact('user', 'activeColocation', 'pastColocationsCount'));
    }
}
