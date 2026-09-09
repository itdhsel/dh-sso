@extends('layouts.app')

@section('title', 'Selayang Hospital SSO Portal')

@section('content')
<div class="portal-wrapper">

    <!-- Top Header Card -->
    <header class="portal-header">
        <div class="user-info">
            <h1>Welcome, {{ $user->name ?? $user->username }}</h1>
            <span class="user-badge">
                <span class="status-dot"></span>
                {{ $user->username ?? '-' }}
            </span>
        </div>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn-logout">
                Sign Out
            </button>
        </form>
    </header>

    @php
        // Map application codes to their respective departments
        $departmentMap = [
            'cme'      => 'Medical Department',
            'imonitor' => 'Pharmacy Department',
            'ir'       => 'Quality Department',
        ];

        // Group applications by department
        $groupedApps = $apps->groupBy(function($app) use ($departmentMap) {
            return $departmentMap[strtolower($app->code)] ?? 'General Department';
        });
    @endphp

    <!-- Categorized Applications Section -->
    <main class="portal-main">
        @foreach($groupedApps as $department => $categoryApps)
            <div class="department-section">
                <h2 class="section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    {{ $department }}
                </h2>

                <div class="app-grid">
                    @foreach($categoryApps as $app)
                    <div class="app-card">
                        <div class="app-card-body">
                            <div class="app-icon">
                                {{ $app->icon }}
                            </div>
                            <h3 class="app-title">{{ $app->name }}</h3>
                            <p class="app-desc">{{ $app->description }}</p>
                        </div>

                        <a href="{{ route('sso.launch', $app->code) }}" target="_blank" rel="noopener noreferrer" class="btn-launch">
                            <span>Open Application</span>
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

    <!-- Page Footer -->
    <footer class="portal-footer">
        © {{ date('Y') }} Hospital Selayang. Developed by Muhammad Haziq Zikri (ITD HSEL)
    </footer>

</div>
@endsection