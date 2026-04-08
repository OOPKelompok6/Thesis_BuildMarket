@props(['method', 'action'])
<form method="{{ $method }}" action="{{ $action }}" class="my-auto d-flex vw-50 align-items-center flex-column">
    {{ $slot }}
</form>