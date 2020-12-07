<h3><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h3>
<p>Content: {{ $post->content }} </p>
<p class="text-muted">
    Added {{ $post->created_at->diffForHumans() }}
    {{-- by {{ $post->user->name }} (Id: {{ $post->user->id }}) --}}
    by {{ $post->user->name }}

</p>

@if($post->comments_count)
    <p class="text-muted">{{ $post->comments_count}} comments</p>
@else
    <p class="text-muted">No Comments Yet!</p>
@endif

<div class="mb-3">
    @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary" >Edit</a>
    @endcan

    {{-- @cannot('delete', $post)
        <p>You cannot delete this post</p>
    @endcannot --}}

    @can('delete', $post)
        <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">

        @csrf

        @method('DELETE')

        <input class="btn btn-danger" type="submit" value="Delete">
        </form>
    @endcan
    <hr>
    
</div>
