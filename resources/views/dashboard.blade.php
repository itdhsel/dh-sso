<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enterprise Dashboard - SSO Portal Hospital Selayang</title>

    <!-- Force Tailwind via CDN to bypass old layout issues -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased text-gray-900 min-h-screen flex flex-col">

    <!-- Corporate Top Navigation -->
    <nav class="bg-slate-900 shadow-xl border-b-4 border-blue-600 relative z-20">
        <!-- Subtle dot pattern for texture -->
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#38bdf8 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-30">
            <div class="flex justify-between items-center h-20">
                
                <!-- Logo & Brand -->
                <div class="flex items-center">
                    <div class="bg-white p-2 rounded mr-4 shadow-sm">
                        <img src="{{ asset('images/hsel-logo.png') }}" alt="Hospital Selayang Logo" class="h-10 w-auto">
                    </div>
                    <div class="border-l-2 border-gray-600 pl-4 py-1">
                        <h1 class="text-xl font-bold text-white tracking-tight uppercase">SSO Portal</h1>
                        <p class="text-[10px] text-blue-400 uppercase tracking-widest font-semibold">Hospital Selayang</p>
                    </div>
                </div>

                <!-- User Menu & Logout -->
                <div class="flex items-center gap-6">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-white">{{ $user->name ?? $user->username }}</p>
                        <p class="text-xs text-gray-400 flex items-center justify-end gap-1 mt-0.5">
                            <span class="inline-block w-2 h-2 bg-green-500 rounded-full shadow-[0_0_5px_#22c55e]"></span>
                            {{ $user->username ?? '-' }}
                        </p>
                    </div>
                    
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium py-2 px-5 rounded transition-colors border border-slate-600 shadow-sm">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    @php
        // Map application codes to their respective departments
        $departmentMap = [
            'cme'      => 'Medical Department',
            'imonitor' => 'Pharmacy Department',
            'ir'       => 'Quality Department',
        ];

        // Group applications by department with fallback
        $groupedApps = $apps->groupBy(function($app) use ($departmentMap) {
            $code = strtolower(is_object($app) ? $app->code : ($app['code'] ?? ''));
            return $departmentMap[$code] ?? 'General Department';
        });
    @endphp

    <!-- Main Content Area -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10 relative z-10">
        
        <div class="mb-10">
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Enterprise Applications</h2>
            <p class="text-slate-500 mt-1">Select an authorized system to launch your secure session.</p>
        </div>

        @foreach($groupedApps as $department => $categoryApps)
            <div class="mb-12">
                
                <!-- Department Section Header -->
                <div class="mb-6 flex items-center gap-3 border-b border-gray-300 pb-2">
                    <h3 class="text-xl font-bold text-slate-700 tracking-tight uppercase">{{ $department }}</h3>
                </div>

                <!-- Application Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categoryApps as $app)
                    @php
                        $appCode = is_object($app) ? $app->code : $app['code'];
                        $appName = is_object($app) ? $app->name : $app['name'];
                        $appIcon = is_object($app) ? $app->icon : $app['icon'];
                        $appDesc = is_object($app) ? $app->description : $app['description'];
                    @endphp
                    
                    <!-- Corporate App Card -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 hover:-translate-y-1 hover:shadow-xl hover:border-blue-300 transition-all duration-200 flex flex-col">
                        
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-12 h-12 bg-slate-100 rounded-md flex items-center justify-center border border-slate-200 text-blue-800 font-bold text-lg flex-shrink-0">
                                @if($appIcon)
                                    {!! $appIcon !!}
                                @else
                                    {{ strtoupper(substr($appName, 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 leading-tight">{{ $appName }}</h4>
                                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mt-1">Authorized</p>
                            </div>
                        </div>
                        
                        <p class="text-sm text-slate-600 mb-6 flex-grow">{{ $appDesc }}</p>
                        
                        <a href="{{ route('sso.launch', $appCode) }}" target="_blank" rel="noopener noreferrer" class="flex justify-center items-center gap-2 w-full bg-blue-50 hover:bg-blue-600 text-blue-800 hover:text-white font-semibold py-2.5 px-4 rounded transition-colors border border-blue-200 hover:border-blue-600">
                            <span>Launch System</span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
                
            </div>
        @endforeach

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs font-medium text-slate-500">
            © {{ date('Y') }} Hospital Selayang. Developed by Muhammad Haziq Zikri (ITD HSEL)
        </div>
    </footer>

</body>
</html>