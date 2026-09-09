@extends('layouts.app')


@section('title', 'DH Dashboard')


@section('content')


<section class="card">


    <h1>
        Welcome,
        {{ $user->name ?? $user->username }}
    </h1>


    <p>
        Username:
        {{ $user->username ?? '-' }}
    </p>


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