@extends('layouts.app')

@section('title', 'Colocation Dashboard - ColocSaaS')

@section('page_category', 'Colocations')

@section('content')
<div class="px-4 py-8 lg:px-12 max-w-[1400px] mx-auto">
        @if(session('success'))
            <div class="mb-6 flex items-center justify-between gap-3 rounded-xl border border-emerald-100 bg-emerald-50/50 p-4 text-emerald-800 shadow-sm animate-in fade-in slide-in-from-top-4 duration-500">
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

        <div class="mb-8 flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-2xl font-medium tracking-tight text-slate-900">
                    {{ $colocation->name }} - {{ $colocation->city }}
                </h1>
                <p class="text-sm text-slate-500">
                    Main Colocation • ID: {{ strtoupper(substr($colocation->id, 0, 8)) }} •
                    <span class="text-green-600">Active</span>
                </p>
            </div>
            <div class="flex gap-3">
                @if ($role == 'ROLE_OWNER' && $activeUsers = 1 || $role != 'ROLE_OWNER' )
                <form action="{{ route('colocation.quite', $colocation->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="flex text-red-400 items-center gap-2 rounded border border-red-200 bg-red-100 px-4 py-2 text-sm font-medium hover:bg-slate-50">
                        Quiter
                    </button>
                </form>
                @elseif ($role == 'ROLE_OWNER')
                    <form action="{{ route('colocation.cancel', $colocation->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="flex text-red-400 items-center gap-2 rounded border border-red-200 bg-red-100 px-4 py-2 text-sm font-medium hover:bg-slate-50">
                            Cancel Colocation
                        </button>
                    </form>
                @endif
                <a href="{{ route('expenses.create', $colocation->id) }}" class="flex items-center gap-2 rounded bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90 shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    New Expense
                </a>
            </div>
        </div>

        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded border border-slate-200 bg-white p-5">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Monthly Budget</p>
                <div class="mt-2 flex items-baseline gap-1">
                    <span class="text-2xl font-semibold tracking-tight">12,500</span>
                    <span class="text-sm font-medium text-slate-400">MAD</span>
                </div>
                <p class="mt-1 text-[11px] text-slate-400">Projected: 15,000 MAD</p>
            </div>
            <div class="rounded border border-slate-200 bg-white p-5">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">My Balance</p>
                <div class="mt-2 flex items-baseline gap-1">
                    <span class="text-2xl font-semibold tracking-tight text-rose-600">-450</span>
                    <span class="text-sm font-medium text-rose-400">MAD</span>
                </div>
                <p class="mt-1 text-[11px] text-slate-400 uppercase tracking-widest font-bold text-rose-500/80">Action Needed</p>
            </div>
            <div class="rounded border border-slate-200 bg-white p-5">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Group Members</p>
                <div class="mt-2 flex items-baseline gap-1">
                    <span class="text-2xl font-semibold tracking-tight font-semibold">{{ count($users) }}</span>
                    <span class="text-sm font-medium text-slate-400">Active</span>
                </div>
                <p class="mt-1 text-[11px] text-slate-400">2 pending invites</p>
            </div>
            <div class="rounded border border-slate-200 bg-white p-5">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Active Tasks</p>
                <div class="mt-2 flex items-baseline gap-1">
                    <span class="text-2xl font-semibold tracking-tight">8</span>
                    <span class="text-sm font-medium text-slate-400">Open</span>
                </div>
                <p class="mt-1 text-[11px] text-slate-400">3 due today</p>
            </div>
        </div>

        <div class="mb-6 flex border-b border-slate-200">
            <button class="border-b-2 border-primary px-4 py-2 text-sm font-medium text-primary">Overview</button>
            <button class="border-b-2 border-transparent px-4 py-2 text-sm font-medium text-slate-500 hover:text-slate-700">History</button>
            <button class="border-b-2 border-transparent px-4 py-2 text-sm font-medium text-slate-500 hover:text-slate-700">Settings</button>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-8">
                <section>
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold tracking-tight">Colocation Roommates</h2>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-slate-400">Live Housemates & Balances</span>
                        </div>
                    </div>
                    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm whitespace-nowrap">
                                <thead class="bg-slate-50/50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    <tr>
                                        <th class="px-6 py-4">Roommate</th>
                                        <th class="px-6 py-4">Role</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4">Balance</th>
                                        @if ($role == 'ROLE_OWNER')
                                        <th class="px-6 py-4 text-right">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($users as $roommate)
                                    <tr class="hover:bg-slate-50/80 transition-colors group">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="relative">
                                                    <img class="h-9 w-9 rounded-full border border-slate-200 shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode($roommate->username) }}&background=4848e5&color=fff&size=36" alt="">
                                                    <div class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-white bg-green-500"></div>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-slate-900 leading-tight">{{ $roommate->username }}</p>
                                                    <p class="text-[10px] text-slate-500">{{ $roommate->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider border {{ $roommate->pivot->role == 'ROLE_OWNER' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-slate-100 text-slate-600 border-slate-200' }}">
                                                {{ str_replace('ROLE_', '', $roommate->pivot->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-[11px] font-semibold {{ $roommate->pivot->status == 'ACTIVE' ? 'text-emerald-600' : 'text-slate-400' }} tracking-wide">{{ $roommate->pivot->status }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-bold tabular-nums">
                                                <span class="{{ $roommate->balance >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                                    {{ $roommate->balance >= 0 ? '+' : '' }}{{ number_format($roommate->balance, 2) }} 
                                                    <span class="text-[10px] {{ $roommate->balance >= 0 ? 'text-emerald-400/80' : 'text-rose-400/80' }} font-medium ml-0.5 uppercase">MAD</span>
                                                </span>
                                            </div>
                                        </td>
                                        @if ($role == 'ROLE_OWNER')
                                        <td class="px-6 py-4 text-right">
                                            @if ($roommate->id !== auth()->id() && $roommate->pivot->role !== 'ROLE_OWNER')
                                            <div class="flex justify-end gap-1">
                                                <form action="{{ route('colocation.fire', [$colocation->id, $roommate->id]) }}" method="POST" onsubmit="return confirm('Kick {{ $roommate->username }} from colocation?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="h-8 w-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all group/btn" title="Remove Roommate">
                                                        <span class="material-symbols-outlined !text-[18px]">person_remove</span>
                                                    </button>
                                                </form>
                                            </div>
                                            @else
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-slate-50 text-[9px] font-bold text-slate-400 uppercase tracking-widest border border-slate-100">
                                                <span class="material-symbols-outlined !text-[12px]">security</span>
                                                Master
                                            </span>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            <div class="space-y-6">
                <section class="rounded border border-slate-200 bg-white p-4">
                    <h3 class="mb-3 text-sm font-semibold">Location</h3>
                    <div class="mb-3 h-32 w-full overflow-hidden rounded bg-slate-100">
                        <img alt="City" class="h-full w-full object-cover grayscale opacity-80" src="https://images.unsplash.com/photo-1526772662000-3f88f10405ff?auto=format&fit=crop&w=400&q=80"/>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium">{{ $colocation->city }}, Morocco</p>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ $colocation->address }}, <br />
                            Casablanca 20250
                        </p>
                    </div>
                </section>

                <section class="rounded border border-slate-200 bg-white p-4">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-sm font-semibold">Housemates</h3>
                        <span class="text-[10px] font-bold text-primary uppercase">{{ count($users) }} ONLINE</span>
                    </div>
                    <div class="space-y-3">
                        @foreach($users as $user)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img alt="{{ $user->username }}" class="h-8 w-8 rounded-full border border-slate-100" src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=random"/>
                                <div>
                                    <p class="text-xs font-medium">{{ $user->username }}</p>
                                    <p class="text-[10px] text-slate-500 uppercase">{{ $user->pivot->role }}</p>
                                </div>
                            </div>
                            <div class="h-1.5 w-1.5 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.4)]"></div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <section class="rounded border border-slate-200 bg-white p-4 uppercase tracking-tight">
                    <h3 class="mb-3 text-sm font-semibold">Send Invites</h3>
                    <div class="space-y-3">
                        <div class="pt-2">
                            <form action="{{ route('colocations.invite', $colocation->id) }}" method="POST" class="space-y-2">
                                @csrf
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">mail</span>
                                    <input type="email" name="email" placeholder="Invite by email..." 
                                           class="h-9 w-full rounded border border-slate-200 bg-slate-50 pl-9 text-xs focus:ring-1 focus:ring-primary focus:border-primary" required>
                                </div>
                                <button type="submit" class="cursor-pointer w-full rounded border border-dashed border-slate-300 py-2 text-xs font-medium text-slate-500 hover:border-primary hover:text-primary transition-all">
                                    + Add New Housemate
                                </button>
                                
                                @if(session('success'))
                                    <div class="mt-2 flex items-center gap-2 rounded-md border border-emerald-100 bg-emerald-50 px-3 py-2 text-[11px] font-medium text-emerald-700 shadow-sm animate-in fade-in slide-in-from-top-1 duration-300 text-transform-none">
                                        <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="mt-2 flex items-center gap-2 rounded-md border border-rose-100 bg-rose-50 px-3 py-2 text-[11px] font-medium text-rose-700 shadow-sm animate-in fade-in slide-in-from-top-1 duration-300 text-transform-none">
                                        <span class="material-symbols-outlined text-[16px]">error</span>
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
