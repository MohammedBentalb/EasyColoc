@extends('layouts.app')

@section('title', 'My Profile - ColocSaaS')

@section('page_category', 'Settings')

@section('content')
<div class="px-4 py-8 lg:px-12 max-w-[1000px] mx-auto">
    <div class="mb-8 flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
        <div>
            <h1 class="text-2xl font-medium tracking-tight text-slate-900">
                My Profile
            </h1>
            <p class="text-sm text-slate-500">
                Manage your account and view your colocation history
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        <div class="md:col-span-1 space-y-6">
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm flex flex-col items-center p-6 text-center">
                <div class="relative mb-4">
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile picture" class="h-24 w-24 rounded-full border border-slate-200 object-cover shadow-sm">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=4848e5&color=fff&size=96" alt="Profile picture placeholder" class="h-24 w-24 rounded-full border border-slate-200 shadow-sm">
                    @endif
                    <div class="absolute bottom-1 right-1 h-5 w-5 rounded-full border-4 border-white {{ $activeColocation ? 'bg-green-500' : 'bg-slate-300' }}"></div>
                </div>
                
                <h2 class="text-xl font-bold tracking-tight text-slate-900">{{ $user->username }}</h2>
                <p class="text-sm text-slate-500 mb-4">{{ $user->email }}</p>
                
                <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                    <span class="material-symbols-outlined !text-[14px] mr-1 text-primary">verified_user</span>
                    {{ $user->role->name ?? 'User' }}
                </span>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">My Reputation</p>
                <div class="mt-2 flex items-baseline gap-1">
                    <span class="text-3xl font-semibold tracking-tight {{ $user->reputation >= 0 ? 'text-primary' : 'text-rose-600' }}">
                        {{ $user->reputation > 0 ? '+' : '' }}{{ $user->reputation }}
                    </span>
                    <span class="text-sm font-medium text-slate-400">PTS</span>
                </div>
                
                <div class="mt-3">
                    @if($user->reputation >= 0)
                        <p class="text-[11px] text-slate-500 bg-slate-50 p-2 rounded border border-slate-100 italic">"You are considered a reliable and clean roommate."</p>
                    @else
                        <p class="text-[11px] text-rose-500 bg-rose-50 p-2 rounded border border-rose-100 italic">"You have a history of leaving debts behind."</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="md:col-span-2 space-y-6">
            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-center gap-2 border-b border-slate-100 pb-4">
                    <span class="material-symbols-outlined text-primary">home_pin</span>
                    <h3 class="text-lg font-semibold tracking-tight">Current Residence</h3>
                </div>
                
                @if($activeColocation)
                    <div class="flex items-center justify-between rounded-lg border border-slate-100 bg-slate-50 p-4">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-lg bg-emerald-100 flex justify-center items-center text-emerald-600">
                                <span class="material-symbols-outlined text-2xl">apartment</span>
                            </div>
                            <div>
                                <h4 class="text-md font-bold text-slate-800">{{ $activeColocation->name }}</h4>
                                <p class="text-xs text-slate-500">{{ $activeColocation->city }}, {{ $activeColocation->address }}</p>
                            </div>
                        </div>
                        <a href="{{ route('colocations.index', $activeColocation->id) }}" class="rounded bg-white px-3 py-1.5 text-xs font-semibold text-slate-600 shadow-sm border border-slate-200 hover:bg-slate-50 transition-colors">
                            Dashboard
                        </a>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center rounded-lg border border-dashed border-slate-300 bg-slate-50 py-8 text-center">
                        <span class="material-symbols-outlined mb-2 text-slate-400 text-3xl">home_work</span>
                        <p class="text-sm font-medium text-slate-600">No Active Colocation</p>
                        <p class="mt-1 text-xs text-slate-400 max-w-[250px]">You are not currently part of any active colocation group.</p>
                        <a href="{{ route('colocations.create') }}" class="mt-4 rounded bg-primary px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-primary/90 transition-colors">
                            Create New Space
                        </a>
                    </div>
                @endif
            </section>

            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-center gap-2 border-b border-slate-100 pb-4">
                    <span class="material-symbols-outlined text-primary">history</span>
                    <h3 class="text-lg font-semibold tracking-tight">Colocation History</h3>
                </div>

                <div class="flex items-center border-l-2 border-primary pl-4">
                    <div>
                        <p class="text-2xl font-bold tracking-tight text-slate-800">{{ $pastColocationsCount }}</p>
                        <p class="text-xs font-medium uppercase text-slate-500 tracking-wider">Past Colocations</p>
                    </div>
                </div>
                <p class="mt-3 text-sm text-slate-500">
                    A record of the previous colocation groups you've been a part of.
                </p>
            </section>
        </div>
    </div>
</div>
@endsection
