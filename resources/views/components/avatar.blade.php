@props(['name' => '', 'src' => null, 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'h-8 w-8 text-xs',
        'md' => 'h-11 w-11 text-sm',
        'lg' => 'h-24 w-24 text-2xl',
        'xl' => 'h-28 w-28 text-3xl',
    ];
    $dimension = $sizes[$size] ?? $sizes['md'];

    $initials = collect(explode(' ', trim((string) $name)))
        ->filter()
        ->take(2)
        ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');
@endphp

<span {{ $attributes->merge(['class' => $dimension.' inline-flex shrink-0 select-none items-center justify-center overflow-hidden rounded-full bg-gradient-to-br from-nord-5 to-nord-4 font-semibold uppercase tracking-wide text-nord-3 ring-1 ring-nord-0/10']) }}>
    @if ($src)
        <img src="{{ $src }}" alt="{{ $name }}" class="h-full w-full object-cover">
    @else
        {{ $initials ?: '·' }}
    @endif
</span>
