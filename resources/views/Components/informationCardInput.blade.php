@props(['label', 'inputType', 'varName', 'placeholder'])

<div {{ $attributes->merge(['class' => 'd-flex flex-column me-auto']) }}>
    <p style="font-size: 0.72rem;" class="mb-0 text-secondary">{{ $label }}</p>
    <input style="background-color: #a4a4a48f;" type="{{ $inputType }}" class="form-control w-100" name="{{ $varName }}" id="{{ $varName }}" placeholder="{{ $placeholder }}">
</div>