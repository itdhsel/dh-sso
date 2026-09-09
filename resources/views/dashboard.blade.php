@extends('layouts.app')

@section('title', 'DH Dashboard')

@section('content')

<section class="card">

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="margin-bottom: 4px;">
                Welcome,
                {{ $user->name ?? $user->username }}
            </h1>

            <p style="margin-top: 0; color: #6b7280;">
                Username:
                {{ $user->username ?? '-' }}
            </p>
        </div>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" style="background-color: #dc2626; color: white; padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">
                Sign Out
            </button>
        </form>
    </div>

    <hr>

    <h2>
        Applications
    </h2>

    <div class="app-grid">

        @foreach($apps as $app)

        <div class="app-card">

            <div class="app-icon">
                {{ $app->icon }}
            </div>

            <h3>
                {{ $app->name }}
            </h3>

            <p>
                {{ $app->description }}
            </p>

            <a href="{{ route('sso.launch',$app->code) }}">
                Open
            </a>

        </div>

        @endforeach

    </div>

</section>

@endsection