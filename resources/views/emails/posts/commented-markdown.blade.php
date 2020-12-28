@component('mail::message')
# Your blog post has received a new Comment!

Hi {{ $comment->commentable->user->name }}

You have received a new Comment on your "{{ $comment->commentable->title }}" post.

{{ $comment->user->name }} commented:

@component('mail::panel')
{{ $comment->content }}
@endcomponent

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
View your Post
@endcomponent

@component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id])])
{{ $comment->user->name }} - View Profile
@endcomponent

Well done - it's great to know people are reacting to your posts!<br>
{{ config('app.name') }}
@endcomponent
