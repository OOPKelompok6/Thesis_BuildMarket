<div {{ $attributes->merge(['class' => 'd-flex flex-row w-75 mx-auto']) }}>
    <div class="d-flex flex-column me-5">
        {{ $leftSide }}
    </div>

    <div class="d-flex flex-column ms-5">
        {{ $rightSide }}
    </div>
</div>
{{ $bottomSide ?? '' }}