@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

<form action="{{ route('posts.store') }}" method="POST">

    @csrf     <!-- Cross Site Request Forgery protection - add to EVERY FORM! -->

    {{-- <div>
        <label for="title">Post Title</label>
        <input type="text" name="title" value="{{ old('title')}}">
    </div>
    @error('title')
        <div>{{ $message }}</div>
    @enderror

    <div>
        <label for="content">Post Content</label>
        <textarea name="content">{{ old('content') }}</textarea>
    </div>
    @error('content')
        <div>{{ $message }}</div>
    @enderror
    
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    
    {{-- ALL THE ABOVE CODE MOVED TO VIEWS/POSTS/PARTIALS/FORM TO THEN USE FOR 'EDIT' AND 'CREATE' --}}

    @include('posts.partials.form')

    <h3>User Name = {{ Auth::user()->name }}</h3>
    <h3>User id = {{ Auth::user()->id }}</h3>

    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Create Post">
    </div>
</form>

@endsection
