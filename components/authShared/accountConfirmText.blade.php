@props(['message', 'messageLink', 'messageText'])

<div {{ $attributes->merge(['class' => 'd-flex flex-row form-text']) }}>
    <p class="me-1">{{ $message }}</p>
    <a href="{{ $messageLink }}">{{ $messageText }}</a>
</div>