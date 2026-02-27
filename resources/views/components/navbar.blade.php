<header
    class="flex items-center justify-between whitespace-nowrap border-b border-slate-200 bg-white px-6 py-3 lg:px-20"
>
    <div class="flex items-center gap-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3 text-primary">
            <div
                class="size-8 flex items-center justify-center rounded-lg bg-primary text-white"
            >
                <span class="material-symbols-outlined">corporate_fare</span>
            </div>
            <h2
                class="text-slate-900 text-lg font-bold leading-tight tracking-tight"
            >
                ColocSaaS
            </h2>
        </a>
        <div class="hidden md:flex items-center gap-6">
            <a
                class="text-slate-600 text-sm font-medium hover:text-primary transition-colors {{ request()->routeIs('colocations.home') ? 'text-primary' : '' }}"
                href="{{ route('colocations.home') }}"
                >Dashboard</a
            >
            <a
                class="text-slate-600 text-sm font-medium hover:text-primary transition-colors {{ request()->routeIs('expenses.index') ? 'text-primary' : '' }}"
                href="{{ route('expenses.index') }}"
                >Expenses</a
            >
            <a
                class="text-slate-600 text-sm font-medium hover:text-primary transition-colors"
                href="#"
                >Members</a
            >
            <a
                class="text-slate-600 text-sm font-medium hover:text-primary transition-colors"
                href="#"
                >Settings</a
            >
        </div>
    </div>
    <div class="flex items-center gap-4">
        <label
            class="hidden sm:flex flex-col min-w-40 h-9 max-w-64"
        >
            <div
                class="flex w-full flex-1 items-stretch rounded-lg h-full border border-slate-200"
            >
                <div
                    class="text-slate-400 flex items-center justify-center pl-3"
                >
                    <span
                        class="material-symbols-outlined !text-[18px]"
                        >search</span
                    >
                </div>
                <input
                    class="form-input flex w-full min-w-0 flex-1 border-none bg-transparent focus:outline-0 focus:ring-0 placeholder:text-slate-400 px-2 text-sm"
                    placeholder="Search colocation..."
                />
            </div>
        </label>
        <button
            class="flex items-center justify-center rounded-lg h-9 w-9 bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors"
        >
            <span class="material-symbols-outlined">notifications</span>
        </button>
        <div
            class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-9 border border-slate-200"
            style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=4848e5&color=fff');"
        ></div>
        @auth
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">logout</span>
                </button>
            </form>
        @endauth
    </div>
</header>
