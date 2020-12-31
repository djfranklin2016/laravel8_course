<div class="mb-2 mt-2">
    @auth
        <form action="{{ $route }}" method="POST">
    
            @csrf     <!-- Cross Site Request Forgery protection - add to EVERY FORM! -->
    
            <p>Hi {{ Auth::user()->name }} (id: {{ Auth::user()->id }}) feel free to Add a Comment below !</p>
    
            <div class="form-group">
                <textarea class="form-control" id="content" name="content"></textarea>
            </div>
    
            <x-errors></x-errors>
            
            <div>
                <input class="btn btn-primary btn-block" type="submit" value="@lang('Add Comment')">
            </div>
        </form>
        {{-- <x-errors></x-errors> --}}
    @else
        Please <a href="{{ route('login') }}">Log-In</a> to post a Comment!
    @endauth
    <hr>
    </div>
    