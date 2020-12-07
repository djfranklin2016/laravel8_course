@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

    <h1>Master Laravel 8 Course</h1>
    <h3>Home Page</h3>
    <br>
    @if(Auth::check())
        <h5>Welcome back {{ Auth::user()->name }}!</h5>
        
        {{-- @if($user->is_admin) --}}
        @if(Auth::user()->is_admin)
            <p>Status: Logged In - Admin</p>
        @else
            <p>Status: Logged In - User</p>
        @endif
    @else
        <p>Status: Welcome Visitor!</p>
    @endif

@endsection
