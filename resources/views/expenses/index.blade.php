@extends('layouts.app')

@section('title', 'Expense Tracker - ColocSaaS')

@section('page_category', $colocation->name)
@section('page_link', route('colocations.index', $colocation->id))

@section('content')
<div class="px-4 py-8 lg:px-12 max-w-[1200px] mx-auto">
    <div class="mb-8 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Expenses</h1>
            <p class="text-sm text-slate-500">Track and settle pending payments within your colocation.</p>
        </div>
        <a href="{{ route('expenses.create', $colocation->id) }}" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition-all">
            <span class="material-symbols-outlined !text-sm">add</span>
            Add Expense
        </a>
    </div>

    <div class="mb-6 flex items-center justify-between border-b border-slate-200 pb-2">
        <div class="flex items-center gap-2">
            <h2 class="text-xs font-bold uppercase tracking-wider text-slate-500 ml-1">Expense List</h2>
        </div>
        <form action="{{ route('expenses.index', $colocation->id) }}" method="GET" class="flex items-center gap-2">
            <label for="filter" class="text-xs font-medium text-slate-500">Filter:</label>
            <select name="filter" id="filter" onchange="this.form.submit()" class="rounded-md border-slate-200 py-1.5 pl-3 pr-8 text-xs font-medium text-slate-700 shadow-sm focus:border-primary focus:ring-primary outline-none cursor-pointer transition-all">
                <option value="all" {{ ($filter ?? request('filter', 'all')) === 'all' ? 'selected' : '' }}>All Expenses</option>
                <option value="paid" {{ ($filter ?? request('filter', 'all')) === 'paid' ? 'selected' : '' }}>Paid by me</option>
                <option value="unpaid" {{ ($filter ?? request('filter', 'all')) === 'unpaid' ? 'selected' : '' }}>Unpaid by me</option>
                <option value="made_by_me" {{ ($filter ?? request('filter', 'all')) === 'made_by_me' ? 'selected' : '' }}>Made by me</option>
            </select>
        </form>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50/50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Title</th>
                        <th class="px-6 py-4 font-semibold">Category</th>
                        <th class="px-6 py-4 font-semibold">Overall Status</th>
                        <th class="px-6 py-4 font-semibold">My Status</th>
                        <th class="px-6 py-4 font-semibold">Amount Due</th>
                        <th class="px-6 py-4 font-semibold">Payer</th>
                        <th class="px-6 py-4 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($expenses as $expense)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4">
                            <a href="{{ route('expenses.show', $expense->id) }}" class="text-slate-900 font-medium hover:text-primary transition-colors">
                                {{ $expense->title }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-[10px] font-bold text-slate-600 uppercase tracking-wider border border-slate-200">
                                {{ $expense->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-xs">
                            {{ $expense->status }}
                        </td>
                        <td class="px-6 py-4">
                            @if($expense->is_paid)
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-emerald-700 border border-emerald-200">
                                    <span class="material-symbols-outlined !text-[12px]">check_circle</span>
                                    Paid
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-red-700 border border-red-200">
                                    <span class="material-symbols-outlined !text-[12px]">pending</span>
                                    Due
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-900 font-bold">
                            {{ number_format($expense->amount / $totalUsers, 2) }} <span class="text-[10px] text-slate-400 font-normal ml-0.5">MAD</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <img class="h-6 w-6 rounded-full border border-slate-200 shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode($expense->user->username) }}&background=random&size=24" alt="">
                                <span class="text-xs font-medium text-slate-700">{{ $expense->user->username }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2 outline-none">
                                <a href="{{ route('expenses.show', $expense->id) }}" class="rounded-lg border border-slate-200 px-3 py-1.5 text-[11px] font-bold text-slate-700 hover:bg-slate-50 transition-all flex items-center gap-1">
                                    <span class="material-symbols-outlined !text-[14px]">visibility</span>
                                    Details
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center gap-3">
                                <span class="material-symbols-outlined text-4xl text-slate-300">receipt_long</span>
                                <p>No expenses found for this colocation.</p>
                                <a href="{{ route('expenses.create', $colocation->id) }}" class="text-primary hover:underline text-xs font-semibold">Add your first expense</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($expenses->hasPages())
        <div class="flex items-center justify-between border-t border-slate-200 px-6 py-4 bg-slate-50/30">
            <div class="text-xs text-slate-500">
                Showing <span class="font-semibold text-slate-900">{{ $expenses->firstItem() }}</span> to <span class="font-semibold text-slate-900">{{ $expenses->lastItem() }}</span> of <span class="font-semibold text-slate-900">{{ $expenses->total() }}</span> results
            </div>
            <div class="flex items-center gap-1">
                {{ $expenses->links() }}
            </div>
        </div>
        @endif
    </div>

    <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Total Expenses</p>
            <p class="mt-2 text-2xl font-bold text-slate-900">
                {{ number_format($expenses->sum('amount'), 2) }} 
                <span class="text-xs font-medium text-slate-400">MAD</span>
            </p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Active Members</p>
            <p class="mt-2 text-2xl font-bold text-primary">
                {{ $colocation->users()->count() }}
                <span class="text-xs font-medium text-primary/60">Housemates</span>
            </p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Monthly Budget</p>
            <p class="mt-2 text-2xl font-bold text-slate-900">
                12,500
                <span class="text-xs font-medium text-slate-400">MAD</span>
            </p>
        </div>
    </div>
</div>
@endsection
