<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - Welcome Back</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-25..0" rel="stylesheet"/>
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet"/>
</head>
<body class="bg-background-light min-h-screen flex items-center justify-center p-4 auth-page-body">
    <div class="w-full max-w-md bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden auth-card">
        <div class="p-8 pb-0 flex flex-col items-center text-center">
            <div class="mb-4 flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 text-primary">
                <span class="material-symbols-outlined text-2xl">lock_open</span>
            </div>
            <h1 class="text-slate-900 text-xl font-bold tracking-tight">Welcome back</h1>
            <p class="text-slate-500 text-sm mt-2">Enter your credentials to access your account</p>
        </div>

        <div class="p-8">
            <form action="{{ route('login') }}" class="space-y-5" method="POST" id="loginForm" novalidate>
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none text-slate-900 flex items-center gap-2" for="email">
                        Email
                    </label>
                    <div class="relative">
                        <input class="flex h-10 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all font-display" 
                               id="email" 
                               name="email" 
                               placeholder="name@example.com" 
                               type="email"
                               value="{{ old('email') }}"/>
                        <p id="email-error" class="hidden text-xs text-red-500 mt-1"></p>
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium leading-none text-slate-900 flex items-center gap-2" for="password">
                            Password
                        </label>
                        <a class="text-xs font-medium text-slate-500 hover:text-primary transition-colors" href="#">
                            Forgot password?
                        </a>
                    </div>
                    <div class="relative">
                        <input class="flex h-10 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all font-display" 
                               id="password" 
                               name="password" 
                               placeholder="••••••••" 
                               type="password"/>
                        <p id="password-error" class="hidden text-xs text-red-500 mt-1"></p>
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <input class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary" id="remember" name="remember" type="checkbox"/>
                    <label class="text-sm text-slate-500 font-normal" for="remember">Remember me for 30 days</label>
                </div>
                <button class="w-full flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow transition-all hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 active:scale-[0.98]" 
                        type="submit">
                    Sign In
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
                @error('server')
                    <p class="text-xs text-red-500 mt-2 text-center">{{ $message }}</p>
                @enderror
            </form>
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <span class="w-full border-t border-slate-200"></span>
                </div>
                <div class="relative flex justify-center text-xs uppercase">
                    <span class="bg-white px-2 text-slate-500">Or continue with</span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-900 shadow-sm hover:bg-slate-50 transition-colors">
                    <svg aria-hidden="true" class="mr-2 h-4 w-4" data-icon="github" data-prefix="fab" focusable="false" role="img" viewbox="0 0 496 512" xmlns="http://www.w3.org/2000/svg"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-56.4 104.2-111.5 110.5 9.2 7.9 17.4 22.9 17.4 46.3 0 33.5-.3 60.5-.3 68.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5.7 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-.7zm-14.4-11.3c-1.3 1-1 4.3 1 6.2 2.2 2.3 5.2 2.6 6.5.7 1.3-1.3.7-4.3-1-6.2-2.2-2.3-5.2-2.6-6.5-.7z" fill="currentColor"></path></svg>
                    GitHub
                </button>
                <button class="flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-900 shadow-sm hover:bg-slate-50 transition-colors">
                    <svg aria-hidden="true" class="mr-2 h-4 w-4" data-icon="google" data-prefix="fab" focusable="false" role="img" viewbox="0 0 488 512" xmlns="http://www.w3.org/2000/svg"><path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" fill="currentColor"></path></svg>
                    Google
                </button>
            </div>
        </div>
        <div class="px-8 py-6 bg-slate-50 border-t border-slate-200 text-center">
            <p class="text-sm text-slate-500">
                Don't have an account? 
                <a class="font-medium text-slate-500 underline underline-offset-4 hover:text-primary transition-colors" href="{{ route('register') }}">Create an account</a>
            </p>
        </div>
    </div>
    <div class="fixed top-0 left-0 -z-10 h-full w-full pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] h-[50%] w-[50%] rounded-full bg-primary/5 blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] h-[50%] w-[50%] rounded-full bg-primary/5 blur-[120px]"></div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
