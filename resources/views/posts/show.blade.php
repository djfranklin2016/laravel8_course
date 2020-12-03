@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p>Added {{ $post->created_at->diffForHumans() }}</p>
    <hr>

@if(now()->diffInMinutes($post->created_at) < 5)
<div class="alert alert-info">New!</div>
@endif

<h3>Posts.Show User Name = {{ Auth::user()->name }} !</h3>
<h3>Posts.Show User id = {{ Auth::user()->id }} !</h3>

<h3>Posts.Show Post User ID = {{ $post->user_id }} !</h3>

<h4>Comments:</h4>

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
