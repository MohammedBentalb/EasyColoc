<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation to EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4848e5',
                        'bg-light': '#f6f6f8',
                        'bg-dark': '#111121',
                    }
                }
            }
        }
    </script>
    <style>
        /* Fallback for email clients that don't support tailwind CDN */
        .email-body { background-color: #f6f6f8; font-family: ui-sans-serif, system-ui, -apple-system, sans-serif; }
        .email-container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
        .btn-primary { background-color: #4848e5; color: #ffffff !important; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; }
    </style>
</head>
<body class="bg-[#f6f6f8] font-sans antialiased text-gray-900 m-0 p-0">
    <div class="max-w-[600px] mx-auto my-10 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="pt-10 pb-6 px-10 text-center">
            <span class="text-2xl font-extrabold text-primary tracking-tight">EasyColoc</span>
        </div>

        <!-- Content -->
        <div class="px-10 pb-10 text-center">
            <h1 class="text-2xl font-bold text-[#111121] mb-4">You're invited!</h1>
            <p class="text-gray-600 leading-relaxed mb-8">
                Hello! You have been invited to join a colocation on <span class="font-semibold text-gray-900">EasyColoc</span>. 
                Click the button below to accept the invitation and start collaborating with your roommates.
            </p>
            
            <a href="{{ $url }}" class="inline-block bg-primary hover:bg-opacity-90 text-white font-semibold py-3.5 px-8 rounded-lg transition duration-200">
                Accept Invitation
            </a>
            
            <div class="mt-8 pt-8 border-t border-gray-100 text-left">
                <p class="text-xs text-gray-400 mb-2">If the button above doesn't work, copy and paste this link:</p>
                <p class="text-xs text-primary break-all select-all">{{ $url }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-10 py-8 text-center border-t border-gray-100">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} EasyColoc. All rights reserved.</p>
            <div class="mt-4 flex justify-center space-x-4">
                <a href="#" class="text-xs text-gray-400 hover:text-primary underline">Privacy Policy</a>
                <a href="#" class="text-xs text-gray-400 hover:text-primary underline">Terms of Service</a>
            </div>
        </div>
    </div>
</body>
</html>
