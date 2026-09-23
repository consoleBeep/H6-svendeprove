<x-layouts.public :title="'QR-kode — '.$memorialPage->full_name">
    <div class="print:hidden">
        <a href="{{ route('memorial-pages.show', $memorialPage) }}"
           class="inline-flex min-w-0 max-w-full items-center gap-1.5 text-sm font-medium text-nord-3 transition hover:text-nord-1">
            <svg class="h-4 w-4 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 0 1 0 1.06L9.06 10l3.73 3.71a.75.75 0 1 1-1.06 1.06l-4.25-4.24a.75.75 0 0 1 0-1.06l4.25-4.24a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/></svg>
            <span class="min-w-0 truncate">{{ $memorialPage->full_name }}</span>
        </a>

        <h1 class="mt-4 font-serif text-2xl font-semibold tracking-tight text-nord-0">QR-kode til gravstedet</h1>
        <p class="mt-1 max-w-prose text-sm text-nord-3">
            Print kortet nedenfor og sæt det op ved gravstedet, så besøgende kan scanne koden
            med deres mobilkamera og komme direkte til mindesiden — uden at skulle søge efter navnet.
        </p>
    </div>

    {{-- Printable card --}}
    <div class="mx-auto mt-8 max-w-xs rounded-2xl border border-nord-4 bg-nord-6 p-8 text-center shadow-sm
                print:mt-0 print:max-w-none print:rounded-none print:border-0 print:bg-white print:p-0 print:shadow-none">
        <img src="{{ route('memorial-pages.qr.svg', $memorialPage) }}"
             alt="QR-kode til {{ $memorialPage->full_name }}s mindeside"
             class="mx-auto h-48 w-48 print:h-64 print:w-64">

        <p class="mt-4 break-words font-serif text-lg font-semibold text-nord-0 print:text-black">
            {{ $memorialPage->full_name }}
        </p>
        @if ($memorialPage->lifespan)
            <p class="text-sm text-nord-3 print:text-black">{{ $memorialPage->lifespan }}</p>
        @endif

        <p class="mt-3 text-xs uppercase tracking-widest text-nord-3 print:text-black">
            Scan for at læse mindesiden
        </p>
        <p class="mt-1 break-all text-[11px] text-nord-3 print:text-black">{{ $url }}</p>
    </div>

    {{-- Actions --}}
    <div class="mx-auto mt-6 flex max-w-xs items-center justify-center gap-3 print:hidden">
        <button type="button" onclick="window.print()"
                class="inline-flex items-center gap-1.5 rounded-full bg-nord-10 px-4 py-2 text-sm font-medium text-white transition hover:bg-nord-9">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5 4a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3h1a2 2 0 0 1 2 2v5a1 1 0 0 1-1 1h-2v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1H3a1 1 0 0 1-1-1V9a2 2 0 0 1 2-2h1V4Zm2 9v3h6v-3H7Zm8-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
            </svg>
            Print
        </button>
        <a href="{{ route('memorial-pages.qr.png', $memorialPage) }}"
           class="rounded-full border border-nord-4 bg-nord-6 px-4 py-2 text-sm font-medium text-nord-1 transition hover:bg-nord-5">
            Download PNG
        </a>
    </div>
</x-layouts.public>
