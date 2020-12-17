@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')

<div class="row">
    <div class="col-8">
        @forelse($posts as $key => $post)

            @include('posts.partials.post', [])     {{-- the 2nd argument can pass parameters to post.partials --}}

        @empty
            <p style = "color: rgb(230, 48, 48)">
                <strong>No Posts Found!</strong>
            </p>
        @endforelse
    </div>
    <div class="col-4">

        @include('posts.partials.activity')

    </div>
</div>

@endsection
