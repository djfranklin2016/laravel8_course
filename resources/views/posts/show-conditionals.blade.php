@extends('layouts.app')

@section('title', $post['title'])

@section('content')

@if($post['is_new'])
    <div>A new Blog Post using IF</div>
{{-- @elseif(!$post['is_new']) --}}
@else(!$post['is_new'])
    <div>Blog post is Old using ELSEIF/ELSE</div>
@endif

    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>

@unless($post['is_new'])
    <div>It is an Old post using UNLESS</div>
@endunless

@if(isset($post['has_comments']))
    <div>The Post has some Comments using ISSET</div>
@endif

@endsection
