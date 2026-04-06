@props(['label', 'varName'])

<div {{ $attributes->merge(['class' => 'd-flex flex-column me-auto']) }}>
    <p style="font-size: 0.72rem;" class="mb-0 text-secondary">{{ $label }}</p>
    <select style="background-color: #a4a4a48f;" class="form-select w-100" name="{{ $varName }}" id="{{ $varName }}">
        {{ $slot }}
    </select>
</div>