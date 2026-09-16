<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center rounded-full border border-nord-4 bg-nord-6 px-4 py-2 text-sm font-medium text-nord-2 transition hover:bg-nord-5 focus:outline-none focus:ring-2 focus:ring-nord-10 focus:ring-offset-2 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
