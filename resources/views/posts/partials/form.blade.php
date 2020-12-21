<div class="form-group">
    <label for="title">Post Title</label>
    <input id="title" class="form-control" type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}">
</div>
{{-- @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror --}}

<div class="form-group">
    <label for="content">Post Content</label>
    <textarea class="form-control" id="content" name="content">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>

{{-- MOVED to Errors Component and Registered with AppServiceProvider --}}
{{-- @if($errors->any())
    <div class="mb-3">
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

{{-- @errors        // Not Laravel 8 syntax !
@enderrors --}}

<div class="form-group">
    <label for="thumbnail">Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
</div>


<x-errors></x-errors>
