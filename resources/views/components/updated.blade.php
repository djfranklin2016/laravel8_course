<p class="text-muted">
    {{ empty(trim($slot)) ? 'Added ' : $slot }} {{ $date }}
    @if(isset($name))
        @if(isset($userId))     {{-- If we have a User Id then create a link to that User profile page--}}
            by <a href="{{ route('users.show', ['user' => $userId]) }}">{{ $name }}</a>
        @else
            by {{ $name }}
        @endif
    @endif
</p>
