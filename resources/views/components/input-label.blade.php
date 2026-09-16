@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-nord-2']) }}>
    {{ $value ?? $slot }}
</label>
