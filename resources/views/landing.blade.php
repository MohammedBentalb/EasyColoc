@extends('layouts.app')

@section('header')
    @include('partials.landing-header')
@endsection

@section('content')

<section class="py-16 md:py-24">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center rounded-full border border-primary/20 bg-primary/5 px-3 py-1 mb-6">
            <span class="text-xs font-bold text-primary uppercase tracking-wider">New: Version 2.0 is out</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900 mb-6 max-w-2xl mx-auto leading-tight">
            Manage your colocation with ease.
        </h1>
        <p class="text-lg text-slate-600 mb-10 max-w-xl mx-auto leading-relaxed">
            The all-in-one platform for shared living. Track expenses, chores, and house rules in one simple workspace.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <button class="w-full sm:w-auto bg-primary text-white font-semibold px-8 py-3 rounded-lg hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2">
                Get Started <span class="material-symbols-outlined">arrow_forward</span>
            </button>
            <button class="w-full sm:w-auto bg-white border border-slate-200 text-slate-700 font-semibold px-8 py-3 rounded-lg hover:bg-slate-50 transition-all">
                View Demo
            </button>
        </div>
        
        <div class="mt-16 relative">
            <div class="absolute -inset-1 bg-gradient-to-r from-primary to-blue-400 rounded-xl blur opacity-10"></div>
            <div class="relative bg-white border border-slate-200 rounded-xl shadow-2xl overflow-hidden aspect-video max-w-4xl mx-auto">
                <div class="bg-slate-50 border-b border-slate-200 h-8 flex items-center px-4 gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-slate-300"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-slate-300"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-slate-300"></div>
                </div>
                <div class="p-4 flex items-center justify-center h-full bg-slate-50/50">
                    <div class="w-full h-full bg-white rounded-lg border border-slate-200 shadow-sm flex overflow-hidden text-[10px]">

                        <div class="w-32 border-r border-slate-100 bg-slate-50/50 p-3 flex flex-col gap-4">
                            <div class="flex items-center gap-1.5 mb-2">
                                <div class="w-4 h-4 rounded bg-primary"></div>
                                <div class="h-2 w-12 bg-slate-200 rounded"></div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center gap-2 px-2 py-1 bg-white border border-slate-200 rounded shadow-sm text-slate-900 font-medium text-left">
                                    <span class="material-symbols-outlined !text-[12px]">dashboard</span> Dashboard
                                </div>
                                <div class="flex items-center gap-2 px-2 py-1 text-slate-500 hover:text-slate-900 transition-colors">
                                    <span class="material-symbols-outlined !text-[12px]">payments</span> Expenses
                                </div>
                                <div class="flex items-center gap-2 px-2 py-1 text-slate-500 hover:text-slate-900 transition-colors">
                                    <span class="material-symbols-outlined !text-[12px]">cleaning_services</span> Chores
                                </div>
                                <div class="flex items-center gap-2 px-2 py-1 text-slate-500 hover:text-slate-900 transition-colors">
                                    <span class="material-symbols-outlined !text-[12px]">group</span> Roommates
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 flex flex-col bg-white">
                            <header class="h-10 border-b border-slate-100 px-4 flex items-center justify-between">
                                <div class="w-32 h-5 bg-slate-50 border border-slate-200 rounded px-2 flex items-center gap-2">
                                    <span class="material-symbols-outlined !text-[10px] text-slate-400">search</span>
                                    <div class="h-1 w-16 bg-slate-200 rounded"></div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-5 w-5 rounded-full bg-slate-100 border border-slate-200"></div>
                                </div>
                            </header>
                            <main class="p-4 space-y-4">

                                <div class="grid grid-cols-3 gap-3">
                                    <div class="p-3 border border-slate-200 rounded-lg bg-white text-left">
                                        <div class="text-slate-500 font-medium mb-1">Total Balance</div>
                                        <div class="text-sm font-bold text-slate-900">$1,284.50</div>
                                        <div class="text-[8px] text-green-600 mt-1">+12% from last month</div>
                                    </div>
                                    <div class="p-3 border border-slate-200 rounded-lg bg-white text-left">
                                        <div class="text-slate-500 font-medium mb-1">Pending Tasks</div>
                                        <div class="text-sm font-bold text-slate-900">08</div>
                                        <div class="text-[8px] text-slate-400 mt-1">3 due today</div>
                                    </div>
                                    <div class="p-3 border border-slate-200 rounded-lg bg-white text-left">
                                        <div class="text-slate-500 font-medium mb-1">Active Rules</div>
                                        <div class="text-sm font-bold text-slate-900">14</div>
                                        <div class="text-[8px] text-slate-400 mt-1">Updated 2d ago</div>
                                    </div>
                                </div>

                                <div class="border border-slate-200 rounded-lg overflow-hidden">
                                    <div class="bg-slate-50 px-3 py-2 border-b border-slate-200 font-medium text-slate-700 text-left">Recent Transactions</div>
                                    <div class="p-0">
                                        <div class="flex items-center px-3 py-2 border-b border-slate-100 text-left">
                                            <div class="w-1/2 flex items-center gap-2"><div class="w-4 h-4 rounded bg-blue-50 text-blue-600 flex items-center justify-center"><span class="material-symbols-outlined !text-[8px]">receipt</span></div> Grocery Bill</div>
                                            <div class="w-1/4 text-slate-500">Jul 24, 2024</div>
                                            <div class="w-1/4 text-right font-semibold text-slate-900">-$42.00</div>
                                        </div>
                                        <div class="flex items-center px-3 py-2 border-b border-slate-100 text-left">
                                            <div class="w-1/2 flex items-center gap-2"><div class="w-4 h-4 rounded bg-green-50 text-green-600 flex items-center justify-center"><span class="material-symbols-outlined !text-[8px]">electric_bolt</span></div> Electricity</div>
                                            <div class="w-1/4 text-slate-500">Jul 22, 2024</div>
                                            <div class="w-1/4 text-right font-semibold text-slate-900">-$85.12</div>
                                        </div>
                                        <div class="flex items-center px-3 py-2 text-left">
                                            <div class="w-1/2 flex items-center gap-2"><div class="w-4 h-4 rounded bg-purple-50 text-purple-600 flex items-center justify-center"><span class="material-symbols-outlined !text-[8px]">wifi</span></div> Internet</div>
                                            <div class="w-1/4 text-slate-500">Jul 20, 2024</div>
                                            <div class="w-1/4 text-right font-semibold text-slate-900">-$35.00</div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-16 bg-slate-50/50 border-y border-slate-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Everything you need to live together</h2>
            <p class="text-slate-500 mt-2">Core tools built for modern roommates.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="group bg-white p-6 rounded-xl border border-slate-200 hover:border-primary/40 hover:shadow-md transition-all duration-300">
                <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Expense Tracking</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Split bills, grocery lists, and manage shared costs instantly without the awkward conversations.
                </p>
            </div>

            <div class="group bg-white p-6 rounded-xl border border-slate-200 hover:border-primary/40 hover:shadow-md transition-all duration-300">
                <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined">cleaning_services</span>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Chore Schedules</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Automated rotations and reminders to keep the shared spaces clean for everyone.
                </p>
            </div>

            <div class="group bg-white p-6 rounded-xl border border-slate-200 hover:border-primary/40 hover:shadow-md transition-all duration-300">
                <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined">calendar_today</span>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Shared Calendar</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Coordinate house meetings, visitors, or rent deadlines with a unified view for the whole house.
                </p>
            </div>
        </div>
    </div>
</section>


<section class="py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-2xl font-bold text-slate-900">10k+</div>
                <div class="text-xs text-slate-500 uppercase tracking-widest mt-1 font-semibold">Active Users</div>
            </div>
            <div>
                <div class="text-2xl font-bold text-slate-900">4.9/5</div>
                <div class="text-xs text-slate-500 uppercase tracking-widest mt-1 font-semibold">App Rating</div>
            </div>
            <div>
                <div class="text-2xl font-bold text-slate-900">500k+</div>
                <div class="text-xs text-slate-500 uppercase tracking-widest mt-1 font-semibold">Bills Settled</div>
            </div>
            <div>
                <div class="text-2xl font-bold text-slate-900">24/7</div>
                <div class="text-xs text-slate-500 uppercase tracking-widest mt-1 font-semibold">Support</div>
            </div>
        </div>
    </div>
</section>
@endsection
