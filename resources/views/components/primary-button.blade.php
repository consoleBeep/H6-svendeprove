<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-full bg-nord-10 px-4 py-2 text-sm font-medium text-white transition hover:bg-nord-9 focus:outline-none focus:ring-2 focus:ring-nord-10 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
