@extends('layouts.app')

@section('title', 'Expense Details - ColocSaaS')

@section('page_category', 'Expenses')

@section('content')
<div class="px-4 py-8 lg:px-12 max-w-[1000px] mx-auto">

    <div class="flex flex-col flex-1">
            <nav class="flex items-center gap-2 mb-6 text-sm">
                <a class="text-slate-500 hover:text-primary transition-colors" href="{{ route('colocations.home') }}">Dashboard</a>
                <span class="material-symbols-outlined text-[14px] text-slate-400">chevron_right</span>
                <a class="text-slate-500 hover:text-primary transition-colors" href="{{ route('colocations.index', $depense->category->colocation->id) }}">{{ $depense->category->colocation->name }}</a>
                <span class="material-symbols-outlined text-[14px] text-slate-400">chevron_right</span>
                <a class="text-slate-500 hover:text-primary transition-colors" href="{{ route('expenses.index', $depense->category->colocation->id) }}">Expenses</a>
                <span class="material-symbols-outlined text-[14px] text-slate-400">chevron_right</span>
                <span class="text-slate-900 font-medium">Expense Details</span>
            </nav>

            <div class="mb-8">
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                    Expense Details
                </h1>
            </div>

            @if(session('success'))
                <div class="mb-6 flex items-center justify-between gap-3 rounded-xl border border-emerald-100 bg-emerald-50/50 p-4 text-emerald-800 shadow-sm animate-in fade-in slide-in-from-top-4 duration-500">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 flex items-center justify-between gap-3 rounded-xl border border-red-100 bg-red-50/50 p-4 text-red-800 shadow-sm animate-in fade-in slide-in-from-top-4 duration-500">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-500">error</span>
                        <p class="text-sm font-medium">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                <div class="h-32 bg-slate-100 border-b border-slate-100 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-primary/10 text-primary border border-primary/20">
                            {{ $depense->category->name }}
                        </span>
                    </div>
                </div>

                <div class="p-8">
                    <div class="mb-8 flex flex-col md:flex-row md:items-center gap-8">
                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-1">
                                Total Amount
                            </p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-extrabold text-slate-900 tracking-tight">MAD {{ number_format($depense->amount, 2) }}</span>
                            </div>
                        </div>

                        <div class="h-12 w-px bg-slate-200 hidden md:block"></div>

                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-1">
                                Your Share
                            </p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-extrabold tracking-tight {{ $isPaid ? 'text-emerald-500' : 'text-red-500' }}">
                                    MAD {{ number_format($shareAmount, 2) }}
                                </span>
                                @if($isPaid)
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
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12 border-t border-slate-100 pt-8">
                        <div class="space-y-1">
                            <p class="text-xs font-semibold text-slate-400 uppercase">Colocation Name</p>
                            <p class="text-sm font-medium text-slate-900">{{ $depense->category->colocation->name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-xs font-semibold text-slate-400 uppercase">Status</p>
                            <p class="text-sm font-medium text-slate-900">{{ $depense->created_at->format('F j, Y') }}</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-xs font-semibold text-slate-400 uppercase">Paid By</p>
                            <div class="flex items-center gap-2">
                                <div class="size-6 rounded-full bg-slate-200 overflow-hidden">
                                    <img alt="User" class="h-full w-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($depense->user->username) }}&background=4848e5&color=fff"/>
                                </div>
                                <span class="text-sm font-medium text-slate-900">{{ $depense->user->username }}</span> {{-- I should probably load the user name here but keeping it simple for now --}}
                            </div>
                        </div>
                        <div class="space-y-2">
                            <p class="text-xs font-semibold text-slate-400 uppercase">Status</p>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-slate-900">{{ $depense->status }}</span> {{-- I should probably load the user name here but keeping it simple for now --}}
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-xs font-semibold text-slate-400 uppercase">Category</p>
                            <div class="flex items-center gap-1.5 text-slate-600">
                                <span class="material-symbols-outlined text-sm">category</span>
                                <span class="text-sm">{{ $depense->category->name }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-slate-100 pt-8">
                        <p class="text-xs font-semibold text-slate-400 uppercase mb-2">Description</p>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            {{ $depense->title }}
                        </p>
                    </div>
                </div>

                <form action="{{ route('expenses.pay', $depense->id) }}" method="POST" class="bg-slate-50 p-6 border-t border-slate-100 flex flex-col sm:flex-row-reverse gap-3">
                    @csrf
                    @if ($share != 'paid')
                        <button class="flex-1 cursor-pointer sm:flex-none inline-flex items-center justify-center rounded-lg bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white shadow transition-colors hover:bg-slate-800">
                            Pay My Share
                        </button>
                    @else
                        <button disabled class="cursor-not-allowed flex-1 sm:flex-none inline-flex items-center justify-center rounded-lg bg-green-600 px-6 py-2.5 text-sm font-semibold text-white shadow">
                            Already Paid
                        </button>
                    @endif
                    <a href="{{ route('expenses.index', $depense->category->colocation->id) }}"  class="flex-1 sm:flex-none inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-6 py-2.5 text-sm font-semibold text-slate-900 transition-colors hover:bg-slate-50">
                    <span class="material-symbols-outlined text-sm mr-2">arrow_back</span>
                    Back to All Expenses
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
