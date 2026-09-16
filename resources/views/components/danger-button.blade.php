<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-full bg-nord-11 px-4 py-2 text-sm font-medium text-white transition hover:bg-nord-11/90 focus:outline-none focus:ring-2 focus:ring-nord-11 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
