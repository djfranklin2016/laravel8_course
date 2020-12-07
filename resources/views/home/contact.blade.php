@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')

    <h1>Master Laravel 8 Course</h1>
    <h3>Contact Page</h3>

    @can('home.secret')
        <p>
            <a href="{{ route('secret') }}">
                Special Admin Contact Details
            </a>
        </p>
    @endcan

@endsection
