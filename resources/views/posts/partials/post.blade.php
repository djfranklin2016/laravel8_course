<h3>
    @if($post->trashed())   {{-- IF post was deleted (soft) then place "strike-through" marker on title text --}}
        <del>
    @endif

    <a class="{{ $post->trashed() ? 'text-muted' : '' }}"   {{-- IF post deleted then mute title text --}}
        href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>

    @if($post->trashed())   {{-- IF post was deleted (soft) then close "strike-through" marker on title text --}}
        <del>
    @endif
</h3>

<p>Content: {{ $post->content }} </p>

{{-- <p class="text-muted">
    Added {{ $post->created_at->diffForHumans() }}
    {{-- by {{ $post->user->name }} (Id: {{ $post->user->id }}) --}}
    {{-- by {{ $post->user->name }}
</p> --}} 

{{-- <x-badge show="{{ now()->diffInMinutes($post->created_at) < 3600 }}">
    Brand New Post !
</x-badge> --}}

<x-updated date="{{ $post->created_at->diffForHumans() }}" name="{{ $post->user->name}}">
    
</x-updated>



@if($post->comments_count)
    <p class="text-muted">{{ $post->comments_count}} comments</p>
@else
    <p class="text-muted">No Comments Yet!</p>
@endif

<div class="mb-3">
    @auth
        @can('update', $post)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary" >Edit</a>
        @endcan
    @endauth

    {{-- @cannot('delete', $post)
        <p>You cannot delete this post</p>
    @endcannot --}}

    @auth
        @if(!$post->trashed())
            @can('delete', $post)
                <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">

                @csrf

                @method('DELETE')

                <input class="btn btn-danger" type="submit" value="Delete">
                </form>
            @endcan
        @endif
    <hr>
    @endauth
</div>
