@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="row">
    <div class="col-8">
        <h1>
            {{ $post->title }}
            {{-- @if(now()->diffInMinutes($post->created_at) < 3600)
                <x-badge type="primary">
                    Brand New Post!
                </x-badge>
            @endif --}}
            <x-badge show="{{ now()->diffInMinutes($post->created_at) < 240 }}">
                Brand New Post !
            </x-badge>
        </h1>

        <p>{{ $post->content }}</p>

        {{-- <p class="text-muted">
            Added {{ $post->created_at->diffForHumans() }}
            by {{ $post->user->name }}
        </p> --}}

        <x-updated date="{{ $post->created_at->diffForHumans() }}" name="{{ $post->user->name}}">
        
        </x-updated>


        {{-- <p>Last updated {{ $post->updated_at->diffForHumans() }} </p> --}}
        
        <x-updated date="{{ $post->updated_at->diffForHumans() }}">
            Updated
        </x-updated>

        {{-- <x-tags tags="{{ $post->tags }}">
        </x-tags> --}}
        
        <x-tags :tags="$post->tags">

        </x-tags>

        <p>Currently being read by {{ $counter }} people.</p>
        <hr>

        {{-- <p>Logged In User: {{ Auth::user()->name }} - Id {{ Auth::user()->id}} </p> --}}
        {{-- <h3>Logged In ID: {{ Auth::user()->id }} </h3> --}}

        <p>This Post's Post_Id : {{ $post->id }} </p>

        <p>This Post's User_Id : {{ $post->user_id }} </p>

        <p>Posted by User: {{ $post->user->name }} - Id {{ $post->user->id}} </p>
        {{-- <h5>Posted by ID: {{ $post->user->name }} </h5> --}}
        <hr>
        <h4>Comments: {{ $post->comments_count }}</h4>

        @include('comments.partials.form')

        @forelse($post->comments as $comment)

            <p>
                <strong>{{ $comment->content }}</strong>
            </p>
            {{-- <p class="text-muted">
                Added {{ $comment->created_at->diffForHumans() }}
                by {{ $post->user->name }}
            </p> --}}

            <x-updated date="{{ $comment->created_at->diffForHumans() }}" name="{{ $comment->user->name}}">
            
            </x-updated>
            
            <hr>
        @empty
            <p class="text-muted">No Comments Yet!</p>
        @endforelse
    </div>
    <div class="col-4">

        @include('posts.partials.activity')

    </div>
</div>
@endsection
