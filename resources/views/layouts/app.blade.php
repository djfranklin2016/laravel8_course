<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Laravel 8 - @yield('title')</title>
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm mb-3">
        <h5 class="my-0 mr-md-auto font-weight-normal ">Laravel 8 App</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            {{-- <a class="p-2 text-dark" href="{{ route('home.index') }}">Home</a> --}}
            <a class="p-2 text-dark" href="{{ route('home.index') }}">@lang('Home')</a>
            {{-- <a class="p-2 text-dark" href="{{ route('home.contact') }}">Contact</a> --}}
            <a class="p-2 text-dark" href="{{ route('home.contact') }}">@lang('Contact')</a>
            {{-- <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a> --}}
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">@lang('Blog Posts')</a>
            {{-- <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add Post</a> --}}
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">@lang('Add Post')</a>

            @guest
                @if (Route::has('register'))
                    <a class="p-2 text-dark" href="{{ route('register') }}">@lang('Register')</a>
                @endif
                <a class="p-2 text-dark" href="{{ route('login') }}">@lang('Login')</a>
            @else
                <a class="p-2 text-dark" href="{{ route('users.show', ['user' => Auth::user()->id ]) }}">@lang('Profile')</a>
                <a class="p-2 text-dark" href="{{ route('users.edit', ['user' => Auth::user()->id ]) }}">@lang('Edit Profile')</a>
                <a class="p-2 text-dark" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('Logout') ({{ Auth::user()->name }})</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
            @endguest
        </nav>
    </div>
    <div class="container">
        @if(session('status'))
            {{-- <div style="background: rgb(218, 136, 233); color: white"> --}}
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif

        @yield('content')
    </div>
</body>

</html>
