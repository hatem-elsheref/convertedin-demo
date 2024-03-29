@extends('layouts.master')

@section('content')
    <h2>Welcome To Task Manager.</h2>

    @guest
        <p class="lead">Login To Explore Our Features</p>

        <p class="lead">
            <a href="{{route('login')}}" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Login</a>
        </p>
    @endguest

@endsection
