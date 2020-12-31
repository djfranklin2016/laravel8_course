@extends('layouts.app')

@section('content')

    <h3>@lang('Please Login')</h3>
    
    <form method="POST" action="{{ route('login') }}">
    @csrf
        
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
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value={{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">@lang('Remember Me')</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">@lang('Login')</button>
    </form>

@endsection
