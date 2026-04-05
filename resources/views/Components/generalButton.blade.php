@props(['message', 'buttonType'])

<{{ $buttonType }} {{ $attributes->merge(['class' => 'btn']) }}>{{ $message }}</{{ $buttonType }}>