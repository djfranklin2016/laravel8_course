@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')

{{-- @if(count($posts))
@foreach($posts as $key => $post)
    <div><strong> {{ $key }}: {{ $post['title'] }}</strong></div>
    <p> {{ $post['content'] }} </p>
    <br>
@endforeach
@else
No Posts Found!
@endif --}}

{{-- ForElse simplifies the above If/Then/Else code --}}
@forelse($posts as $key => $post)
{{-- @break($key == 2)  Stop when key=2 --}}
{{-- @continue($key == 1)    continue After key=1 --}}
    @include('posts.partials.post')

@empty
No Posts Found!
@endforelse

<div>
@for($i = 0; $i<10; $i++)
    @if($i % 2 == 0)    {{-- Check to see if $i is EVEN using modulo ‘%’ operator --}}
        <div>
            <p style="background-color: rgb(188, 253, 188)">The current value is {{ $i }}</p> 
        </div>
    @else
        <div>
            <p style="background-color: rgb(220, 182, 230)">The current value is {{ $i }} </p>
        </div>
    @endif
@endfor
</div>

<div>
@php $done = false @endphp
@while(!$done)
    <div>I'm not done!</div>

    @php
     if (random_int(0,1) == 1) $done = true   
    @endphp
@endwhile
</div>

@endsection
