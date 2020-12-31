@extends('layouts.app')

@section('content')

    <h3>@lang('Please Register')</h3>

    <form method="POST" action="{{ route('register') }}">
    @csrf
        <div class="form-group">
            <label>@lang('Name')</label>
            <input name="name" value="{{ old('name') }}" required
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

            @if($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>@lang('Email')</label>
            <input name="email" value="{{ old('email') }}" required
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">

            @if($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label>@lang('Password')</label>
            <input name="password" type="password" required
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">

            @if($errors->has('password'))
                <strong class="invalid-feedback">{{ $errors->first('password') }}</strong>
            @endif
        </div>

        <div class="form-group">
            <label>@lang('Confirm Password')</label>
            <input name="password_confirmation" type="password" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary btn-block">@lang('Register')</button>
    </form>

@endsection
