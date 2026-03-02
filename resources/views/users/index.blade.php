@extends('layouts.app')

@section('title', 'User Management - ColocSaaS')

@section('page_category', 'Administration')

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
            <h1 class="text-2xl font-medium tracking-tight text-slate-900">User Management</h1>
            <p class="text-sm text-slate-500">Overview of all platform users and global statistics.</p>
        </div>
    </div>

    <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <span class="material-symbols-outlined text-[28px]">group</span>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Total Users</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl font-semibold tracking-tight">{{ count($users) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <span class="material-symbols-outlined text-[28px]">home_work</span>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Total Colocations</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl font-semibold tracking-tight">{{ $totalColocations }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-50 text-sky-600">
                    <span class="material-symbols-outlined text-[28px]">bolt</span>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Active Colocations</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl font-semibold tracking-tight">{{ $activeColocations }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold tracking-tight">Registered Users</h2>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Manage user access and status</span>
            </div>
        </div>
        
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50/50 text-xs font-semibold uppercase tracking-wider text-slate-500 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Joined At</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=6366f1&color=fff&size=40" alt="{{ $user->username }}">
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-semibold text-slate-900">{{ $user->username }}</p>
                                            @if($user->is_admin)
                                                <span class="bg-indigo-50 text-indigo-700 text-[10px] font-bold px-1.5 py-0.5 rounded border border-indigo-100">ADMIN</span>
                                            @endif
                                        </div>
                                        <p class="text-[11px] text-slate-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->banned)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 text-[11px] font-bold border border-rose-100">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                        BANNED
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold border border-emerald-100">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        ACTIVE
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-600">User</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-500">{{ $user->created_at?->format('M d, Y') }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if(!$user->is_admin)
                                    @if($user->banned)
                                        <form action="{{ route('users.unban', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-emerald-200 bg-white text-emerald-600 text-xs font-semibold hover:bg-emerald-50 transition-all shadow-sm">
                                                <span class="material-symbols-outlined !text-[16px]">how_to_reg</span>
                                                Unban User
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.ban', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to ban this user?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-rose-200 bg-white text-rose-600 text-xs font-semibold hover:bg-rose-50 transition-all shadow-sm">
                                                <span class="material-symbols-outlined !text-[16px]">block</span>
                                                Ban User
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-widest">Protected</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(count($users) == 0)
                <div class="py-12 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-400">
                        <span class="material-symbols-outlined text-[32px]">person_search</span>
                    </div>
                    <h3 class="mt-4 text-sm font-semibold text-slate-900">No users found</h3>
                    <p class="mt-1 text-xs text-slate-500">There are currently no registered users on the platform.</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
