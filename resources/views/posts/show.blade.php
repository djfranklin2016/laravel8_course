@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="row">
    <div class="col-8">
        @if($post->image)
        <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
            <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
        @else
            <h1>
        @endif
        {{-- <h1>   // see logic above - if image exists create a div and format image as background image, otherwise just <div>--}}
            {{ $post->title }}
            {{-- @if(now()->diffInMinutes($post->created_at) < 3600)
                <x-badge type="primary">
                    Brand New Post!
                </x-badge>
            @endif --}}
            <x-badge show="{{ now()->diffInMinutes($post->created_at) < 240 }}">
                Brand New Post !
            </x-badge>
        @if($post->image)
            </h1>
        </div>
        @else
            </h1>
        @endif
        {{-- </h1>  // see above logic - if image exists close <h1> and <div> otherwise just close <h1> --}}

        <p>{{ $post->content }}</p>

        {{-- <p class="text-muted">
            Added {{ $post->created_at->diffForHumans() }}
            by {{ $post->user->name }}
        </p> --}}

        {{-- dd({{ Storage::url($post->image->path) }}); --}}

        {{-- "Storage::" all moved to Image Model url() function --}}
        {{-- <img src="{{ Storage::url($post->image->path) }}" /> --}}
        
        {{-- <img src="{{ $post->image->url() }}" /> --}}

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

        {{-- @include('comments.partials.form') --}}

        {{-- comment-form component --}}
        <x-commentForm route="{{ route('posts.comments.store', ['post' => $post->id]) }}">
        </x-commentForm>

        {{-- <x-commentList comments="{{ $post->comments }}"> --}}
        <x-commentList :comments="$post->comments">
        </x-commentList>

    </div>
    <div class="col-4">

        @include('posts.partials.activity')

    </div>
</div>
@endsection
