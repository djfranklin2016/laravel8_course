@if($errors->any())
    <div class="mt-3 mb-3">
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger mb-3">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
