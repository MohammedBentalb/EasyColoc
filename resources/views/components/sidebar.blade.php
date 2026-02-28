<aside 
    id="sidebar-container"
    class="relative"
>
    <!-- Mobile Backdrop -->
    <div 
        id="sidebar-backdrop"
        class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden hidden opacity-0 transition-opacity duration-300"
    ></div>

    <div 
        id="sidebar-content"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200 transform -translate-x-full transition-transform duration-300 ease-in-out lg:sticky lg:top-0 lg:h-screen lg:flex flex-col lg:translate-x-0"
    >
        <div class="h-16 flex items-center px-6 border-b border-slate-100">
            <a href="{{ route('home') }}" class="flex items-center gap-3 text-primary">
                <div class="size-8 flex items-center justify-center rounded-lg bg-primary text-white shadow-sm shadow-primary/20">
                    <span class="material-symbols-outlined">corporate_fare</span>
                </div>
                <h2 class="text-slate-900 text-lg font-bold leading-tight tracking-tight">
                    ColocSaaS
                </h2>
            </a>
            <button id="close-sidebar" class="ml-auto lg:hidden text-slate-400 hover:text-slate-600">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
            <p class="px-2 mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Main Menu</p>
            
            <a href="{{ route('colocations.home') }}" 
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('colocations.home') ? 'bg-primary/5 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="material-symbols-outlined !text-[20px] {{ request()->routeIs('colocations.home') ? 'text-primary' : 'text-slate-400 group-hover:text-slate-600' }}">dashboard</span>
                Colocations
            </a>
            
            @php
                $activeColoc = auth()->user() ? auth()->user()->getActiveColocation()->first() : null;
            @endphp
            
            @if ($activeColoc)
            <a href="{{ route('expenses.index', $activeColoc->id) }}" 
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('expenses.index') ? 'bg-primary/5 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="material-symbols-outlined !text-[20px] {{ request()->routeIs('expenses.index') ? 'text-primary' : 'text-slate-400 group-hover:text-slate-600' }}">payments</span>
                Expenses
            </a>

            @if (auth()->user() && auth()->user()->getUserColocationRole() == 'ROLE_OWNER')
            <a href="{{ route('colocations.index', $activeColoc->id) }}" 
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all group text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                <span class="material-symbols-outlined !text-[20px] text-slate-400 group-hover:text-slate-600">group</span>
                Members
            </a>
            @endif

            <a href="{{ route('categories', $activeColoc->id) }}" 
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('categories') ? 'bg-primary/5 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="material-symbols-outlined !text-[20px] {{ request()->routeIs('categories') ? 'text-primary' : 'text-slate-400 group-hover:text-slate-600' }}">category</span>
                Categories
            </a>
            @endif

            <div class="pt-4 mt-4 border-t border-slate-100">
                <p class="px-2 mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Account</p>
                <a href="{{ route('profile') }}" 
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('profile') ? 'bg-primary/5 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <span class="material-symbols-outlined !text-[20px] {{ request()->routeIs('profile') ? 'text-primary' : 'text-slate-400 group-hover:text-slate-600' }}">person</span>
                    My Profile
                </a>
                
                @if(auth()->user() && auth()->user()->is_admin)
                <a href="{{ route('users.index') }}" 
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('users.index') ? 'bg-primary/5 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <span class="material-symbols-outlined !text-[20px] {{ request()->routeIs('users.index') ? 'text-primary' : 'text-slate-400 group-hover:text-slate-600' }}">admin_panel_settings</span>
                    Manage Users
                </a>
                @endif
            </div>
        </nav>

        <div class="p-4 border-t border-slate-100">
            <div class="flex items-center gap-3 px-2 py-2 mb-2">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-10 border border-slate-200"
                     style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username ?? 'User') }}&background=4848e5&color=fff');">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-900 truncate">{{ auth()->user()->username ?? 'Guest User' }}</p>
                    <p class="text-[10px] text-slate-500 truncate">{{ auth()->user()->email ?? 'guest@example.com' }}</p>
                </div>
            </div>
            
            @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-all group">
                    <span class="material-symbols-outlined !text-[20px] text-red-400 group-hover:text-red-600">logout</span>
                    Sign Out
                </button>
            </form>
            @endauth
        </div>
    </div>
</aside>
