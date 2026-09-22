<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secure Login - SSO Portal Hospital Selayang</title>

    <!-- Force Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 font-sans antialiased text-gray-900 overflow-hidden">

    <div class="min-h-screen relative w-full h-full">

        <!-- 1. Right Side Base (Dark Navy + Dot Pattern) -->
        <div class="absolute inset-0 opacity-10 pointer-events-none z-0" style="background-image: radial-gradient(#38bdf8 1.5px, transparent 1.5px); background-size: 32px 32px;"></div>

        <!-- 2. The Angled Accent Stripe (Flipped Angle) -->
        <div class="hidden lg:block absolute inset-y-0 left-0 w-[57%] bg-gradient-to-b from-blue-500 to-cyan-400 [clip-path:polygon(0_0,65%_0,100%_100%,0_100%)] z-0 shadow-2xl"></div>

        <!-- 3. The Angled Left Background (Flipped Angle) -->
        <div class="absolute inset-y-0 left-0 w-full lg:w-[56.5%] bg-gradient-to-br from-slate-50 to-blue-100 lg:[clip-path:polygon(0_0,65%_0,100%_100%,0_100%)] z-10 transition-all duration-500">
            <!-- Decorative Ambient Glows -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
            <div class="absolute bottom-10 left-10 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        </div>
        
        <!-- 4. Content Layer -->
        <div class="relative z-20 flex w-full h-screen pointer-events-none">
            
            <!-- Left Side: Login Form & Footer -->
            <div class="w-full lg:w-[40%] xl:w-[35%] h-full flex flex-col justify-between py-8 px-6 sm:px-10 lg:px-14 xl:px-16 pointer-events-auto">
                
                <!-- Invisible Top Spacer for vertical centering -->
                <div></div>

                <!-- Login Card -->
                <div class="bg-white/90 backdrop-blur-sm p-8 sm:p-10 rounded-2xl shadow-2xl border border-white/50 w-full max-w-md mx-auto">
                    
                    <!-- Logo & Brand Header -->
                    <div class="mb-10 flex items-center">
                        <img src="{{ asset('images/hsel-logo.png') }}" alt="Hospital Selayang Logo" class="h-16 w-auto mr-4">
                        <div class="border-l-2 border-gray-300 pl-4">
                            <h1 class="text-xl font-bold text-gray-800 tracking-tight">SSO PORTAL</h1>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold">Hospital Selayang</p>
                        </div>
                    </div>

                    <!-- Instruction Text -->
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Welcome Back</h2>
                    <p class="text-sm text-gray-500 mb-8 font-medium">Log in with your Active Directory credentials.</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Username Input -->
                        <div class="mb-5">
                            <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Active Directory Username</label>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-gray-50 text-gray-900 shadow-sm"
                                placeholder="e.g. mhaziq">
                            
                            @error('username')
                                <p class="mt-2 text-red-600 text-sm font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-gray-50 text-gray-900 shadow-sm"
                                placeholder="••••••••">
                            
                            @error('password')
                                <p class="mt-2 text-red-600 text-sm font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Login Button -->
                        <div class="mt-8">
                            <button type="submit" class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md tracking-wide">
                                Secure Login
                            </button>
                        </div>
                        
                        @if (Route::has('password.request'))
                            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                                <a class="text-sm font-medium text-blue-700 hover:text-blue-500 transition-colors" href="{{ route('password.request') }}">
                                    Need help signing in?
                                </a>
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Footer anchored to the bottom left -->
                <div class="text-center lg:text-left mt-8">
                    <footer class="text-xs font-semibold text-slate-500">
                        © {{ date('Y') }} Hospital Selayang. Developed by Muhammad Haziq Zikri (ITD HSEL)
                    </footer>
                </div>

            </div>

            <!-- Right Side: Corporate Graphic & Wording -->
            <div class="hidden lg:flex absolute right-0 top-0 h-full w-[45%] xl:w-[45%] flex-col justify-center pr-12 xl:pr-24 pointer-events-auto">
                <div class="border-l-4 border-blue-500 pl-8 max-w-2xl transform hover:translate-x-2 transition-transform duration-300 ml-auto">
                    <h2 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-6 tracking-tight leading-tight">
                        Enterprise Access <br>
                        <span class="text-blue-400">Single Sign-On (SSO)</span>
                    </h2>
                    <p class="text-lg xl:text-xl text-slate-300 font-light leading-relaxed">
                        Authorized access to Hospital Selayang internal applications. This unified authentication gateway ensures secure, compliant connectivity to integrated clinical and administrative systems.
                    </p>
                </div>
            </div>
            
        </div>
    </div>

</body>
</html>