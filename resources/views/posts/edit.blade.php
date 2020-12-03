@extends('layouts.app')

@section('title', 'Update Post')

@section('content')

<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">

    @csrf     <!-- Cross Site Request Forgery protection - add to EVERY FORM! -->
    
    @method('PUT')
    
    @include('posts.partials.form')

    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Update Post">
    </div>
</form>

@endsection
