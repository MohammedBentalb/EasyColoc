@extends('layouts.app')

@section('title', 'Your Colocations - ColocSaaS')

@section('page_category', 'colocations')

@section('content')
<div class="px-4 py-8 lg:px-12 max-w-[1200px] mx-auto">
    <!-- Global Success Message -->
    @if(session('success'))
        <div class="mb-8 flex items-center justify-between gap-3 rounded-xl border border-emerald-100 bg-emerald-50/50 p-4 text-emerald-800 shadow-sm animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100/80 text-emerald-600 shadow-inner">
                    <span class="material-symbols-outlined text-[20px]">check_circle</span>
                </div>
                <div>
                    <p class="text-sm font-semibold">Success!</p>
                    <p class="text-xs text-emerald-700/80">{{ session('success') }}</p>
                </div>
            </div>
            <button onclick="this.parentElement.remove()" class="group flex h-8 w-8 items-center justify-center rounded-full hover:bg-emerald-100 transition-all duration-200">
                <span class="material-symbols-outlined text-[18px] text-emerald-400 group-hover:text-emerald-600">close</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-8 flex items-center justify-between gap-3 rounded-xl border border-red-100 bg-red-50/50 p-4 text-red-800 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-red-100/80 text-red-600 shadow-inner">
                    <span class="material-symbols-outlined text-[20px]">error</span>
                </div>
                <div>
                    <p class="text-sm font-semibold">Error</p>
                    <p class="text-xs text-red-700/80">{{ session('error') }}</p>
                </div>
            </div>
            <button onclick="this.parentElement.remove()" class="flex h-8 w-8 items-center justify-center rounded-full hover:bg-red-100">
                <span class="material-symbols-outlined text-[18px] text-red-400 hover:text-red-600">close</span>
            </button>
        </div>
    @endif

    <div class="space-y-8">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="space-y-1">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                        Your Colocations
                    </h1>
                    <p class="text-slate-500 text-sm">
                        Manage your current and historical shared living arrangements.
                    </p>
                </div>
                @if (isset($activeColocation))
                    <a href="{{ route('colocations.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 text-white rounded-lg text-sm font-semibold hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined !text-[18px]">add</span>
                        Create New Colocation
                    </a>
                @endif
            </div>

            @if (isset($activeColocation))
            <section class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-400">
                        Active Colocation
                    </h2>
                </div>
                <div class="group relative bg-white border border-slate-200 rounded-xl overflow-hidden">
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/3 h-48 md:h-auto bg-center bg-cover" style="background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80');"></div>
                        <div class="flex-1 p-6 flex flex-col justify-between space-y-4">
                            <div class="space-y-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-bold text-slate-900">
                                        {{ $activeColocation->name }}
                                    </h3>
                                    <span class="px-2.5 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase rounded-full">Primary</span>
                                </div>
                                <p class="text-slate-500 text-sm flex items-center gap-1">
                                    <span class="material-symbols-outlined !text-sm">location_on</span>
                                    {{ $activeColocation->address }}, {{ $activeColocation->city}}
                                </p>
                            </div>
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 py-4 border-y border-slate-100">
                                <div>
                                    <p class="text-[10px] font-semibold text-slate-400 uppercase">Balance</p>
                                    <p class="text-lg font-bold text-slate-900">4,500 <span class="text-xs font-medium">MAD</span></p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-semibold text-slate-400 uppercase">Members</p>
                                    <p class="text-lg font-bold text-slate-900">{{ count($activeColocation->users) }} <span class="text-xs font-medium">Active</span></p>
                                </div>
                                <div class="hidden lg:block">
                                    <p class="text-[10px] font-semibold text-slate-400 uppercase">Active Since</p>
                                    <p class="text-sm font-medium text-slate-900 mt-1">Jan 2024</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-end">
                                <a href="{{ route('colocations.index', ['colocation' => $activeColocation->id]) }}" class="px-5 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-colors">
                                    Open colocation
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @else
            <section class="relative overflow-hidden rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 px-6 py-12 text-center">
                <div class="mx-auto max-w-sm space-y-6">
                    <div class="relative mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                        <span class="material-symbols-outlined text-[40px] text-primary/40">home_work</span>
                        <div class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center rounded-full bg-primary text-white shadow-lg">
                            <span class="material-symbols-outlined text-[14px]">add</span>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <h2 class="text-xl font-bold text-slate-900">No Active Colocation Found</h2>
                        <p class="text-sm leading-relaxed text-slate-500">
                            It looks like you aren't part of any shared living space yet. Start by creating a new colocation or ask your housemates for an invitation link.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-center pt-2">
                        <a href="{{ route('colocations.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white transition-all hover:bg-slate-800 hover:shadow-lg active:scale-95">
                            <span class="material-symbols-outlined !text-[18px]">add_circle</span>
                            Create New Space
                        </a>
                    </div>
                </div>

                <div class="absolute -left-12 -top-12 h-40 w-40 rounded-full bg-primary/5 blur-3xl"></div>
                <div class="absolute -right-12 -bottom-12 h-40 w-40 rounded-full bg-blue-500/5 blur-3xl"></div>
            </section>
            @endif

            @if (isset($inActiveColocations))
            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                        <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-400">
                            Previous Colocations
                        </h2>
                    </div>
                    <button class="text-slate-400 hover:text-slate-600">
                        <span class="material-symbols-outlined">filter_list</span>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($inActiveColocations as $inactive)
                    <div class="flex items-center gap-4 p-4 bg-white border border-slate-200 rounded-lg hover:border-slate-300 transition-colors">
                        <div class="size-14 rounded-lg bg-center bg-cover flex-shrink-0" style="background-image: url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=200&q=80');"></div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-slate-900 truncate">{{ $inactive->name }}</h4>
                            <p class="text-xs text-slate-500">{{ $inactive->created_at->format('M y') }} — {{ $inactive->updated_at->format('M y') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] font-bold rounded uppercase">Past</span>
                            <p class="text-[10px] text-slate-400 mt-1">{{ $inactive->users()->count() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="flex justify-center pt-4">
                    <button class="text-xs font-semibold text-slate-400 hover:text-primary transition-colors flex items-center gap-1">
                        View all history
                        <span class="material-symbols-outlined !text-sm">arrow_forward</span>
                    </button>
                </div>
            </section>
            @endif

            <!-- Quick Actions / Tips -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-200 pt-8">
                <div class="p-4 rounded-lg bg-primary/5 space-y-2 border border-primary/10">
                    <span class="material-symbols-outlined text-primary">receipt_long</span>
                    <h5 class="text-xs font-bold text-slate-900 uppercase">Settle Debts</h5>
                    <p class="text-[11px] text-slate-500">Quickly check who owes you or what you owe to others in Sunset Heights.</p>
                </div>
                <div class="p-4 rounded-lg bg-primary/5 space-y-2 border border-primary/10">
                    <span class="material-symbols-outlined text-primary">groups</span>
                    <h5 class="text-xs font-bold text-slate-900 uppercase">Invite Roommate</h5>
                    <p class="text-[11px] text-slate-500">New person moving in? Send them an invitation link to join the group.</p>
                </div>
                <div class="p-4 rounded-lg bg-primary/5 space-y-2 border border-primary/10">
                    <span class="material-symbols-outlined text-primary">analytics</span>
                    <h5 class="text-xs font-bold text-slate-900 uppercase">Reports</h5>
                    <p class="text-[11px] text-slate-500">Analyze your monthly spending patterns across all colocations.</p>
                </div>
        </div>
    </div>
</div>
@endsection
