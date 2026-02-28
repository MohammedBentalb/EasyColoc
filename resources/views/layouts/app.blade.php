<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ColocManager - Shared Living Simplified')</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />


    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .material-symbols-outlined {
            font-size: 20px;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-background-light text-slate-900 font-sans antialiased">
    @if(request()->routeIs('home', 'login', 'register'))
        @yield('header')
        <main>
            @yield('content')
        </main>
        @if(request()->routeIs('home'))
            @include('partials.footer')
        @endif
    @else
        <div class="flex min-h-screen">
            <x-sidebar />
            <div class="flex-1 flex flex-col min-w-0">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-30">
                    <div class="flex items-center gap-4">
                        <button id="open-sidebar" class="lg:hidden p-2 text-slate-600 hover:bg-slate-50 rounded-lg transition-colors">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <div class="hidden lg:flex items-center gap-2">
                             <a href="@yield('page_link', '/colocations')" class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                                @yield('page_category', 'Platform')
                            </a>
                             <span class="text-slate-300">/</span>
                             <span class="text-sm font-bold text-slate-900">
                                @yield('title')
                             </span>
                        </div>
                    </div>  
                </header>

                <main class="flex-1 overflow-x-hidden">
                    @yield('content')
                </main>
            </div>
        </div>
    @endif

    @stack('scripts')
</body>
</html>
