@props(['message', 'formId', 'type', 'innerClass', 'name'])

<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    <label for="{{ $formId }}" class="form-label">{{ $message }}</label>
    <input name="{{ $name }}" type="{{ $type }}" class="{{ $innerClass }}" id="{{ $formId }}"">
</div>

