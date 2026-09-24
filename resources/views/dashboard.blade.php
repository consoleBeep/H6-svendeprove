<x-layouts.public title="Din side" width="wide">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="font-serif text-2xl font-semibold tracking-tight text-nord-0 sm:text-3xl">
                Hej, {{ auth()->user()->name }}
            </h1>
            <p class="mt-1 text-sm text-nord-3">Her er et overblik over dine mindesider.</p>
        </div>
        <a href="{{ route('memorial-pages.create') }}"
           class="inline-flex items-center gap-1.5 rounded-full bg-nord-10 px-4 py-2 text-sm font-medium text-white transition hover:bg-nord-9">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M10 5a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 1 1 0-2h3V6a1 1 0 0 1 1-1Z"/>
            </svg>
            Opret mindeside
        </a>
    </div>

    {{-- Pages the user created --}}
    <section class="mt-8">
        <h2 class="text-sm font-semibold uppercase tracking-widest text-nord-3">
            Dine mindesider · {{ $ownPages->count() }}
        </h2>

        @if ($ownPages->isEmpty())
            <p class="mt-4 rounded-2xl border border-nord-4 bg-nord-6 px-5 py-8 text-center text-sm text-nord-3">
                Du har endnu ikke oprettet en mindeside.
                <a href="{{ route('memorial-pages.create') }}" class="font-medium text-nord-10 hover:underline">Kom i gang</a>.
            </p>
        @else
            <ul class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($ownPages as $page)
                    <li class="flex min-w-0 items-center gap-3 rounded-2xl border border-nord-4 bg-nord-6 p-4">
                        <x-avatar :name="$page->full_name" :src="$page->portrait_url" />
                        <div class="min-w-0 flex-1">
                            <a href="{{ route('memorial-pages.show', $page) }}" class="truncate font-serif font-semibold text-nord-0 hover:underline">
                                {{ $page->full_name }}
                            </a>
                            <p class="text-xs text-nord-3">
                                {{ $page->memories_count }} minder · {{ $page->photos_count }} billeder
                            </p>
                        </div>
                        <a href="{{ route('memorial-pages.edit', $page) }}"
                           class="shrink-0 rounded-full border border-nord-4 bg-nord-6 px-3 py-1.5 text-xs font-medium transition hover:bg-nord-5">
                            Rediger
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    {{-- Pages the user co-administers --}}
    @if ($administeredPages->isNotEmpty())
        <section class="mt-8">
            <h2 class="text-sm font-semibold uppercase tracking-widest text-nord-3">
                Sider du administrerer · {{ $administeredPages->count() }}
            </h2>

            <ul class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($administeredPages as $page)
                    <li class="flex min-w-0 items-center gap-3 rounded-2xl border border-nord-4 bg-nord-6 p-4">
                        <x-avatar :name="$page->full_name" :src="$page->portrait_url" />
                        <div class="min-w-0 flex-1">
                            <a href="{{ route('memorial-pages.show', $page) }}" class="truncate font-serif font-semibold text-nord-0 hover:underline">
                                {{ $page->full_name }}
                            </a>
                            <p class="text-xs text-nord-3">
                                {{ $page->memories_count }} minder · {{ $page->photos_count }} billeder
                            </p>
                        </div>
                        <a href="{{ route('memorial-pages.edit', $page) }}"
                           class="shrink-0 rounded-full border border-nord-4 bg-nord-6 px-3 py-1.5 text-xs font-medium transition hover:bg-nord-5">
                            Rediger
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    <p class="mt-10 text-center text-sm text-nord-3">
        <a href="{{ route('profile') }}" class="font-medium text-nord-10 hover:underline">Kontoindstillinger</a>
    </p>
</x-layouts.public>
