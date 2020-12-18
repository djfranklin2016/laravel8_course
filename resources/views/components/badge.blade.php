@if(!isset($show) || $show)
    <span class="badge badge-{{ $type ?? 'warning' }}">
        {{ $slot }}
    </span>
@endif
