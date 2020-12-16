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
        <div class="container">
            <div class="row">
                {{-- <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Most Commented Posts</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            What people are talking about ...
                        </h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostCommented as $post)  
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                        {{ $post->title}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}

                <x-card title="Most Commented Posts">
                    @slot('subtitle')
                        What people are talking about ...
                    @endslot
                    @slot('items')
                        @foreach ($mostCommented as $post)  
                            <li class="list-group-item">
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                    {{ $post->title}}
                                </a>
                            </li>
                        @endforeach
                    @endslot
                </x-card>
            </div>

            <div class="row mt-4">
                {{-- <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Most Active Members</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            members with the most Posts written ...
                        </h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActive as $user)  
                                <li class="list-group-item">
                                        {{ $user->name }} (user id: {{ $user->id }})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}

                <x-card title="Most Active Members">
                    @slot('subtitle')
                        Members with the most Posts written ...
                    @endslot
                    @slot('items', collect($mostActive)->pluck('name'))
                </x-card>
            </div>

            <div class="row mt-4">
                {{-- <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Most Active Last Month</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            most active members last month ...
                        </h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActiveLastMonth as $user)  
                                <li class="list-group-item">
                                        {{ $user->name }} (user id: {{ $user->id }})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}

                <x-card title="Most Active Last Month">
                    @slot('subtitle')
                        Most active members last month ...
                    @endslot
                    @slot('items', collect($mostActiveLastMonth)->pluck('name'))
                </x-card>
            </div>
        </div>
    </div>
</div>

@endsection
