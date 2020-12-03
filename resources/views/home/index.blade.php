@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

    <h1>Master Laravel 8 Course</h1>
    <h3>Home Page</h3>
    <br>
    @if(Auth::check())
        <h5>Welcome back {{ Auth::user()->name }}!</h5>
    @endif

@endsection
