@extends('layouts.app')

@section('title', 'DH Application Dashboard')

@section('content')
    <section class="card">
        <header class="dashboard-header">
            <div>
                <h1>DH Application Dashboard</h1>

                <p class="subtitle">
                    Signed in as
                    <strong>{{ auth()->user()->name }}</strong>
                    ({{ auth()->user()->username }})
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="secondary-button" type="submit">
                    Sign out
                </button>
            </form>
        </header>

        <div class="app-grid">
            <article class="app-tile">
                <h2>Applications</h2>

                <p class="muted">
                    Authorised applications will appear here after the
                    SSO application catalogue is configured.
                </p>
            </article>
        </div>
    </section>
@endsection