<?php

namespace App\Http\Controllers;

use App\ColocationStatus;
use App\DepenseStatus;
use App\Http\Requests\DepenseCreateRequest;
use App\Http\Requests\ExpenseFilterRequest;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\Settlement;
use Illuminate\Http\Request;

class DepenseController extends Controller {
    public function index(ExpenseFilterRequest $request, Colocation $colocation) {
        $filter = $request->input('filter', 'all');
        $user = $request->user();
        $query = $colocation->depenses()->with('user', 'category')
            ->withExists(['settlements as is_paid' => function ($q) use ($user) {
                $q->where('user_id', $user->id);
            }])->latest();

        if ($filter === 'paid') {
            $query->whereHas('settlements', function ($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            });
        } elseif ($filter === 'unpaid') {
            $query->whereDoesntHave('settlements', function ($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            });
        } elseif ($filter === 'made_by_me') {
            $query->where('user_id', $request->user()->id);
        }

        $expenses = $query->paginate(10)->withQueryString();
        $totalUsers = $user->getActiveColocation()->first()->users->count();
        return view('expenses.index', ['user' => $request->user(), 'colocation' => $colocation, 'expenses' => $expenses, 'filter' => $filter, 'totalUsers' => $totalUsers]);
    }

    public function show(Request $request, Depense $depense) {
        $settlement = $depense->settlements()->where('user_id', $request->user()->id)->exists();
        $shareAmount = $depense->amount / $depense->category->colocation->users->count();
        $share = $settlement ? "paid" : $shareAmount;
        return view('expenses.show', ['user' => $request->user(),  'depense' => $depense->load('user', 'category.colocation'),  'share' => $share, 'shareAmount' => $shareAmount, 'isPaid' => $settlement]);
    }

    public function create(Request $request, Colocation $colocation) {
        $user = $request->user();        
        $categories = $colocation->categories;
        $users = $colocation->users()->wherePivot('status', ColocationStatus::active)->get();
        return view('expenses.create', compact('colocation', 'categories', 'user', 'users'));
    }

    public function store(DepenseCreateRequest $request, Colocation $colocation) {
        $data = $request->validated();
        $depense = Depense::create([...$data, 'status' => DepenseStatus::pending->value]);
        Settlement::create([
            'amount' => $depense->amount / $colocation->users()->count(),
            'depense_id' => $depense->id,
            'user_id' => $data['user_id']
        ]);
        return redirect()->route('colocations.index', $colocation->id)->with('success', 'Expense created successfully.');
    }
    
    public function pay(Depense $depense, Request $request) {
        $user = $request->user();
        $foundSettlement = $depense->settlements()->where('user_id', $user->id)->first();
        if($depense->status == DepenseStatus::paid->value) return back()->withErrors(['error' => "You cannot pay a fully paid expense."]);
        if($foundSettlement) return back()->withErrors(['error' => "You cannot pay what has been already paid by you."]);
    
        $price = $depense->amount / $depense->category->colocation->users->count();
        $settlement = Settlement::create([
            'amount'=> $price,
            'depense_id' => $depense->id,
            'user_id' => $user->id
        ]);

        $totalSettled = $depense->settlements()->sum('amount');
        if (abs($totalSettled - $depense->amount) < 0.01) $depense->update(['status' => DepenseStatus::paid->value]);

        return back()->with('success', "Expense '{$depense->title}' has been paid successfully.");
    }
}