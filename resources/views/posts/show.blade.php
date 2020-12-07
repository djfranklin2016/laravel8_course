@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p class="text-muted">
        Added {{ $post->created_at->diffForHumans() }}
        by {{ $post->user->name }}
    </p>
    <hr>

@if(now()->diffInMinutes($post->created_at) < 5)
<div class="alert alert-info">New!</div>
@endif

<p>Logged In User: {{ Auth::user()->name }} - Id {{ Auth::user()->id}} </p>
{{-- <h3>Logged In ID: {{ Auth::user()->id }} </h3> --}}

<p>This Post's Post_Id : {{ $post->id }} </p>

<p>This Post's User_Id : {{ $post->user_id }} </p>

<p>Posted by User: {{ $post->user->name }} - Id {{ $post->user->id}} </p>
{{-- <h5>Posted by ID: {{ $post->user->name }} </h5> --}}
<hr>
<h4>Comments: {{ $post->comments_count }}</h4>

@forelse($post->comments as $comment)

    <p>
        <strong>{{ $comment->content }}</strong>
    </p>
    <p class="text-muted">
        Added {{ $comment->created_at->diffForHumans() }}
    </p>
    <hr>
@empty
    <p class="text-muted">No Comments Yet!</p>
@endforelse

@endsection
