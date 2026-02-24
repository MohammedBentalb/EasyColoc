<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Register - EasyColoc</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet"/>
</head>
<body class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col items-center justify-center p-4 auth-page-body">
    <div class="w-full max-w-md bg-white border border-zinc-200 rounded-xl shadow-sm p-6 sm:p-8 transform transition-all auth-card font-display">
        <div class="flex flex-col space-y-2 text-center mb-8">
            <div class="flex items-center justify-center mb-2">
                <div class="bg-primary/10 p-2 rounded-lg">
                    <span class="material-symbols-outlined text-primary text-2xl">
                        deployed_code
                    </span>
                </div>
            </div>
            <h1 class="text-2xl font-semibold tracking-tight">Create an account</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">
                Enter your details below to get started
            </p>
        </div>

        <form action="{{ route('register') }}" class="space-y-4" method="POST" enctype="multipart/form-data" id="registerForm" novalidate>
            @csrf
            <div class="flex flex-col items-center justify-center space-y-3 mb-6">
                <div class="relative">
                    <label class="group relative flex h-24 w-24 cursor-pointer flex-col items-center justify-center rounded-full border-2 border-dashed border-zinc-200 bg-white transition-colors hover:bg-zinc-50 hover:border-zinc-300 overflow-hidden" for="profile-upload" id="image-label">
                        <div class="flex flex-col items-center justify-center pt-1" id="upload-placeholder">
                            <span class="material-symbols-outlined text-zinc-400 group-hover:text-primary transition-colors">
                                add_a_photo
                            </span>
                            <span class="mt-1 text-[10px] font-medium text-zinc-500 dark:text-zinc-400">Upload</span>
                        </div>
                        <img id="image-preview" src="" class="hidden absolute inset-0 w-full h-full object-cover" alt="Preview">
                        <input accept="image/*" class="hidden" id="profile-upload" name="image" type="file"/>
                    </label>
                </div>
                <div class="text-center">
                    <p class="text-xs font-medium text-zinc-700 dark:text-zinc-300">Profile Picture</p>
                    <p class="text-[10px] text-zinc-500 dark:text-zinc-500">Optional: JPG or PNG</p>
                    <p id="image-error" class="hidden text-[10px] text-red-500 mt-1"></p>
                    @error('image')
                        <p class="text-xs text-red-500 mt-1 text-center">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-zinc-300" for="username">
                    Username
                </label>
                <input class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all" 
                       id="username" 
                       name="username" 
                       placeholder="johndoe" 
                       value="{{ old('username') }}"
                       type="text"/>
                <p id="username-error" class="hidden text-xs text-red-500 mt-1"></p>
                @error('username')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-zinc-300" for="email">
                    Email Address
                </label>
                <input class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all font-display" 
                       id="email" 
                       name="email" 
                       placeholder="name@example.com" 
                       value="{{ old('email') }}"
                       type="email"/>
                <p id="email-error" class="hidden text-xs text-red-500 mt-1"></p>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-zinc-300" for="password">
                    Password
                </label>
                <div class="relative">
                    <input class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all" 
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
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-zinc-300" for="confirm-password">
                    Confirm Password
                </label>
                <input class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all" 
                       id="confirm-password" 
                       name="confirm-password" 
                       placeholder="••••••••" 
                       type="password"/>
                <p id="confirm-password-error" class="hidden text-xs text-red-500 mt-1"></p>
            </div>
            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-white hover:bg-primary/90 h-10 px-4 py-2 w-full mt-2 active:scale-[0.98]" 
                    type="submit">
                Create Account
            </button>
            @error('server')
                <p class="text-xs text-red-500 mt-2 text-center">{{ $message }}</p>
            @enderror
        </form>
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <span class="w-full border-t border-zinc-200 dark:border-zinc-800"></span>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-white px-2 text-zinc-500 dark:text-zinc-400">
                    Or continue with
                </span>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-zinc-200 bg-white hover:bg-zinc-50 h-10 px-4 py-2 transition-colors">
                <svg aria-hidden="true" class="mr-2 h-4 w-4" data-icon="github" data-prefix="fab" focusable="false" role="img" viewbox="0 0 496 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.5 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 4.1 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-4.1-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z" fill="currentColor"></path>
                </svg>
                Github
            </button>
            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-zinc-200 bg-white hover:bg-zinc-50 h-10 px-4 py-2 transition-colors">
                <svg aria-hidden="true" class="mr-2 h-4 w-4" data-icon="google" data-prefix="fab" focusable="false" role="img" viewbox="0 0 488 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" fill="currentColor"></path>
                </svg>
                Google
            </button>
        </div>
        <p class="px-8 text-center text-sm text-zinc-500 dark:text-zinc-400 mt-8">
            Already have an account? 
            <a class="font-medium text-slate-500 underline underline-offset-4 hover:text-primary transition-colors" href="{{ route('login') }}">
                Log in
            </a>
        </p>
    </div>
    <div class="mt-8 text-center max-w-md">
        <p class="text-[12px] text-zinc-400 dark:text-zinc-500 leading-relaxed">
            By clicking continue, you agree to our 
            <a class="underline hover:text-primary transition-colors" href="#">Terms of Service</a> 
            and 
            <a class="underline hover:text-primary transition-colors" href="#">Privacy Policy</a>.
        </p>
    </div>

    <div class="fixed top-0 left-0 -z-10 h-full w-full pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] h-[50%] w-[50%] rounded-full bg-primary/5 blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] h-[50%] w-[50%] rounded-full bg-primary/5 blur-[120px]"></div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
