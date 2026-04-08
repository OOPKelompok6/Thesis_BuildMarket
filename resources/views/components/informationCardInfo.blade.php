@props(['title', 'name'])

<div {{ $attributes->merge(['class' => 'd-flex flex-column me-auto']) }}>
    <p style="font-size: 0.72rem;" class="mb-0 text-secondary">{{ $title }}</p>
    <p class="text-dark fs-6">{{ $name }}</p>
</div>