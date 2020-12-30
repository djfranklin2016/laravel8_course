@component('mail::message')
# A comment was posted on your Watched Post

Hi {{ $user->name }}

@component('mail::panel')
{{ $comment->content }}
@endcomponent

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
View Post
@endcomponent

@component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id])])
{{ $comment->user->name }} - View Profile
@endcomponent

Thanks, <br>
{{ config('app.name') }}
@endcomponent
