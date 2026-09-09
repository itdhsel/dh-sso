@extends('layouts.app')

@section('title', 'Portal Authentication')

@section('content')
<div class="page">
    <div class="login-card">
        <div class="login-header">
            <h1>DH SSO Portal</h1>
            <p class="subtitle">Enter your credentials to access system resources</p>
        </div>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="username">Username / Email</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus autocomplete="off" placeholder="e.g. mhaziq">
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>

            <div class="remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Keep session active</label>
            </div>

            <button type="submit" class="primary-button">
                Authenticate System
            </button>
        </form>
    </div>
</div>
@endsection