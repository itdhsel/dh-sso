@extends('layouts.app')

@section('title', 'DH SSO Login')

@section('content')
    <section class="card login-card">
        <h1>DH Single Sign-On</h1>

        <p class="subtitle">
            Sign in to access authorised DH applications.
        </p>

        @if ($errors->any())
            <div class="error-box" role="alert">
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
                <label for="username">Username</label>

                <input
                    id="username"
                    name="username"
                    type="text"
                    value="{{ old('username') }}"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="field">
                <label for="password">Password</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <div class="remember">
                <input
                    id="remember"
                    name="remember"
                    type="checkbox"
                    value="1"
                >

                <label for="remember">Keep me signed in</label>
            </div>

            <button class="primary-button" type="submit">
                Sign in
            </button>
        </form>
    </section>
@endsection