@forelse($comments as $comment)

    <p>
        <strong>{{ $comment->content }}</strong>
    </p>
    {{-- <p class="text-muted">
        Added {{ $comment->created_at->diffForHumans() }}
        by {{ $post->user->name }}
    </p> --}}

    <x-updated date="{{ $comment->created_at->diffForHumans() }}" name="{{ $comment->user->name}}" userId="{{ $comment->user->id }}">

    </x-updated>

    <hr>
@empty
    <p class="text-muted">No Comments Yet!</p>
@endforelse