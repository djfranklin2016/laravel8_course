@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')

    @forelse($posts as $key => $post)

        @include('posts.partials.post', [])     {{-- the 2nd argument can pass parameters to post.partials --}}

    @empty
        <p style = "color: rgb(230, 48, 48)">
            <strong>No Posts Found!</strong>
        </p>
    @endforelse

@endsection
