@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10']) }}>
