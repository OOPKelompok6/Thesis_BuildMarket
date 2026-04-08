@props(['name'])

@error($name)
    <p class="fs-6 text-danger mt-1">{{ $message }}</p>
@enderror