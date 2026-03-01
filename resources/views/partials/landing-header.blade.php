<nav class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white/80 backdrop-blur-md" x-data="{ open: false, profileOpen: false }">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <div class="flex items-center gap-8">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="bg-primary/10 p-1.5 rounded-lg group-hover:bg-primary/20 transition-colors">
                        <span class="text-primary material-symbols-outlined font-bold !text-2xl">grid_view</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900">easy<span class="text-primary">Coloc</span></span>
                </a>

                @auth
                <div class="hidden md:flex items-center gap-6">
                    <a href="/" class="text-sm font-medium {{ Request::is('/') ? 'text-primary' : 'text-slate-600 hover:text-primary' }} transition-colors">Home</a>
                    <a href="{{ route('colocations.home') }}" class="text-sm font-medium {{ Request::routeIs('colocations.home') ? 'text-primary' : 'text-slate-600 hover:text-primary' }} transition-colors">Colocations</a>
                </div>
                @endauth
            </div>


            <div class="flex items-center gap-4">
                @guest
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-primary px-3 py-2 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all text-center">Register</a>
                    </div>
                @endguest

                @auth
                    <div class="relative" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 p-1 rounded-full hover:bg-slate-100 transition-all border border-transparent hover:border-slate-200">
                            <div class="h-9 w-9 rounded-full overflow-hidden border-2 border-primary/20">
                                @if(Auth::user()->image)
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->username }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <span class="material-symbols-outlined text-slate-400 !text-18" :class="profileOpen ? 'rotate-180' : ''">expand_more</span>
                        </button>


                        <div x-show="profileOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                             class="absolute right-0 mt-3 w-56 rounded-2xl bg-white border border-slate-200 shadow-xl py-2 z-50 overflow-hidden"
                             style="display: none;">
                            
                            <div class="px-4 py-3 border-b border-slate-100 mb-1">
                                <p class="text-sm font-semibold text-slate-900 leading-none">{{ Auth::user()->username }}</p>
                                <p class="text-xs text-slate-500 mt-1 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined !text-20 opacity-60">dashboard</span>
                                    Dashboard
                                </a>
                            @endif

                            <a href="{{ route('colocations.home') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined !text-20 opacity-60">groups</span>
                                Colocations
                            </a>

                            <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined !text-20 opacity-60">person</span>
                                My Profile
                            </a>

                            <div class="border-t border-slate-100 my-1"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <span class="material-symbols-outlined !text-20 opacity-60">logout</span>
                                    Deconnection
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
