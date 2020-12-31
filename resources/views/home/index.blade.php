@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

    <h1>@lang('Master Laravel 8 Course')</h1>
    {{-- <h3>Home Page</h3> --}}
    {{-- <h3>{{ __('messages.homepage') }}</h3> --}}
    <h3>@lang('messages.homepage')</h3>

    <br>
    @if(Auth::check())
        {{-- <h5>Welcome back {{ Auth::user()->name }}!</h5> --}}
        {{-- <h5>{{ __('messages.welcome') }} {{ Auth::user()->name }}!</h5> --}}

        <h5>@lang('messages.welcome') {{ Auth::user()->name }}!</h5>
        <br>
        <h5>@lang('messages.example_with_value', ['name' => 'Samantha'])</h5>

        <p>@lang(trans_choice('messages.plural', 0, ['a' => '1']))</p>
        <p>@lang(trans_choice('messages.plural', 1, ['a' => '1' ]))</p>
        <p>@lang(trans_choice('messages.plural', 2, ['a' => '1']))</p>

        <p>Using JSON: @lang('Welcome to Laravel!')</p>
        <p>Using JSON: @lang('Hello :name', ['name' => 'Samantha'])</p>
        
        {{-- @if($user->is_admin) --}}
        @if(Auth::user()->is_admin)
            <p>@lang('Status: Logged In - Admin')</p>
        @else
            <p>@lang('Status: Logged In - User')</p>
        @endif
    @else
        <p>@lang('Status: Welcome Visitor!')</p>
    @endif

    <p>@lang('This is the content of the Home Page!')</p>

@endsection
