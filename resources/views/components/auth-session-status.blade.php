@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-sm font-medium text-nord-14']) }}>
        {{ $status }}
    </div>
@endif
