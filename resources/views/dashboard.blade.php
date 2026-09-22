<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enterprise Dashboard - SSO Portal Hospital Selayang</title>

    <!-- Force Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased text-gray-900 h-screen flex flex-col overflow-hidden">

    <!-- Corporate Top Navigation -->
    <nav class="bg-slate-900 shadow-lg border-b-4 border-blue-600 relative z-20 shrink-0">
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
        // 1. Format existing database apps
        $formattedApps = collect($apps)->map(function($app) {
            return [
                'code' => is_object($app) ? $app->code : $app['code'],
                'name' => is_object($app) ? $app->name : $app['name'],
                'icon' => is_object($app) ? $app->icon : $app['icon'],
                'url'  => route('sso.launch', is_object($app) ? $app->code : $app['code']),
            ];
        })->toArray();

        // 2. Define the new external apps using matching EMOJI icons instead of SVGs
        $externalApps = [
            [
                'code' => 'iqms',
                'name' => 'iQMS (Queue Management System)',
                'icon' => '👥',
                'url'  => 'https://jknselangor.moh.gov.my/qms/#!/facility/13',
            ],
            [
                'code' => 'eporter',
                'name' => 'ePorter',
                'icon' => '🚑',
                'url'  => 'https://sites.google.com/moh.gov.my/hseleporter/home',
            ]
        ];

        // 3. Merge all apps together into one flat list
        $allApps = array_merge($formattedApps, $externalApps);

        // Array of vibrant colors matching the reference image style
        $cardColors = [
            'bg-amber-500 shadow-amber-500/30',
            'bg-rose-600 shadow-rose-600/30',
            'bg-purple-600 shadow-purple-600/30',
            'bg-lime-600 shadow-lime-600/30',
            'bg-orange-500 shadow-orange-500/30',
            'bg-fuchsia-800 shadow-fuchsia-800/30',
            'bg-blue-600 shadow-blue-600/30',
            'bg-teal-600 shadow-teal-600/30'
        ];
        $colorIndex = 0;
    @endphp

    <!-- Main Content Area -->
    <main class="flex-grow overflow-y-auto w-full relative z-10 p-6 sm:p-8">
        <div class="max-w-6xl mx-auto">
            
            <!-- Updated Title -->
            <div class="mb-8 border-l-4 border-blue-600 pl-4">
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight uppercase">Selayang Hospital Internal Application</h2>
            </div>

            <!-- Single Unified Grid (Max 3 Columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach($allApps as $app)
                @php
                    $currentColor = $cardColors[$colorIndex % count($cardColors)];
                    $colorIndex++;
                @endphp
                
                <a href="{{ $app['url'] }}" target="_blank" rel="noopener noreferrer" 
                   class="relative block h-32 rounded-lg shadow-lg {{ $currentColor }} overflow-hidden group hover:scale-[1.02] hover:-translate-y-1 transition-all duration-200">
                    
                    <div class="absolute inset-0 opacity-[0.15] pointer-events-none transition-opacity group-hover:opacity-20" 
                         style="background-image: url('data:image/svg+xml,%3Csvg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M12 24L0 12 12 0l12 12-12 12zM12 21.17L21.17 12 12 2.83 2.83 12 12 21.17z\' fill=\'%23ffffff\' fill-rule=\'evenodd\'/%3E%3C/svg%3E'); background-size: 24px 24px;">
                    </div>
                    
                    <div class="absolute top-4 left-4 right-12 z-10">
                        <h4 class="text-white font-bold text-lg leading-tight tracking-wide drop-shadow-sm">{{ $app['name'] }}</h4>
                    </div>

                    <!-- App Icon (Now fully standardizing emojis) -->
                    <div class="absolute bottom-3 right-4 z-10 text-4xl drop-shadow-md">
                        {!! $app['icon'] !!}
                    </div>
                </a>
                @endforeach
            </div>
            
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-4 shrink-0 relative z-20">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs font-semibold text-slate-500">
            © {{ date('Y') }} Hospital Selayang. Developed by Muhammad Haziq Zikri (ITD HSEL)
        </div>
    </footer>

</body>
</html>