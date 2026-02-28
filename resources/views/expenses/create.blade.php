@extends('layouts.app')

@section('title', 'Add New Expense - ColocSaaS')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<style>
    .font-display { font-family: 'Public Sans', sans-serif; }
    #expense-page-container { font-family: 'Public Sans', sans-serif; }
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 20;
    }
</style>
@endpush

@section('content')
<main id="expense-page-container" class="max-w-2xl mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="mb-10">
        <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
            Add New Expense
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Log a shared household expense to split with your roommates.
        </p>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl border border-rose-100 bg-rose-50 text-rose-700 animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="flex items-center gap-3 mb-1">
                <span class="material-symbols-outlined !text-[18px]">error</span>
                <p class="text-sm font-semibold text-rose-800">Validation Error</p>
            </div>
            <ul class="list-disc list-inside text-[11px] space-y-0.5 ml-7 text-rose-700/80">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Expense Form -->
    <form action="{{ route('expenses.store', $colocation->id) }}" method="POST" class="space-y-8 bg-white p-8 rounded-xl border border-slate-200 shadow-sm">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-700" for="title">Expense Title</label>
                    <input
                        class="w-full h-10 px-3 rounded-lg border border-slate-200 bg-transparent text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder:text-slate-400"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="e.g. Fiber Internet Subscription"
                        type="text"
                        required
                    />
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-700" for="amount">Amount</label>
                    <div class="relative">
                        <input
                            class="w-full h-10 pl-3 pr-12 rounded-lg border border-slate-200 bg-transparent text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder:text-slate-400"
                            id="amount"
                            name="amount"
                            value="{{ old('amount') }}"
                            placeholder="0.00"
                            type="number"
                            step="0.01"
                            required
                        />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-xs font-semibold text-slate-500">MAD</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-700" for="category_id">Category</label>
                    <div class="relative">
                        <select
                            class="w-full h-10 px-3 rounded-lg border border-slate-200 bg-transparent text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all appearance-none"
                            id="category_id"
                            name="category_id"
                            required
                        >
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-sm">expand_more</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-700" for="paid-by">Paid By</label>
                    <div class="relative">
                        <select
                            class="w-full h-10 px-3 rounded-lg border border-slate-200 bg-transparent text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all appearance-none"
                            id="user_id"
                            name="user_id"
                        >
                            @if (isset($users))
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}" {{ (old('user_id') == $u->id || (!old('user_id') && $u->id == $user->id)) ? 'selected' : '' }}>
                                        {{ $u->id == $user->id ? "Me ({$user->username})" : $u->username }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-sm">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="description">
                    Description <span class="text-xs font-normal text-slate-400">(Optional)</span>
                </label>
                <textarea
                    class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-transparent text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder:text-slate-400 resize-none"
                    id="description"
                    rows="3"
                    placeholder="Add any extra details about this expense..."
                ></textarea>
            </div>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
            <a
                href="{{ route('expenses.index', $colocation->id) }}"
                class="px-4 h-10 flex items-center justify-center rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors"
            >
                Cancel
            </a>
            <button
                class="px-6 h-10 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm"
                type="submit"
            >
                Create Expense
            </button>
        </div>
    </form>

    <!-- Informational Footer -->
    <div class="mt-8 flex items-start gap-3 p-4 rounded-xl bg-primary/5 border border-primary/10">
        <span class="material-symbols-outlined text-primary text-[20px]">info</span>
        <div>
            <p class="text-xs font-semibold text-primary leading-none mb-1 uppercase tracking-tight">
                Splitting Policy
            </p>
            <p class="text-xs text-slate-600">
                This expense will be split equally among all members of the <strong>{{ $colocation->name }}</strong> colocation by default.
            </p>
        </div>
    </div>
</main>
@endsection
