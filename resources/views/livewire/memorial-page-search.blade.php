<div>
    {{-- Search field --}}
    <div class="mx-auto max-w-md">
        <label for="search" class="sr-only">Søg efter en mindeside</label>
        <div class="relative">
            <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-nord-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 3.4 9.82l3.64 3.63a1 1 0 0 0 1.42-1.42l-3.63-3.63A5.5 5.5 0 0 0 9 3.5ZM5.5 9a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0Z" clip-rule="evenodd"/>
            </svg>
            <input
                id="search"
                type="search"
                wire:model.live.debounce.300ms="query"
                placeholder="Søg efter navn…"
                autocomplete="off"
                class="w-full rounded-full border-nord-4 bg-nord-6 py-3 pl-11 pr-4 text-sm shadow-sm focus:border-nord-10 focus:ring-nord-10"
            >
            <div wire:loading class="absolute right-4 top-1/2 h-4 w-4 -translate-y-1/2 animate-spin rounded-full border-2 border-nord-4 border-t-nord-2"></div>
        </div>
    </div>

    {{-- Results --}}
    <div class="mt-8">
        @if ($results->isEmpty())
            <p class="py-10 text-center text-sm text-nord-3">
                @if (trim($query) !== '')
                    Ingen mindesider matcher “{{ $query }}”.
                @else
                    Der er endnu ingen mindesider.
                @endif
            </p>
        @else
            <ul class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($results as $page)
                    <li class="min-w-0">
                        <a href="{{ route('memorial-pages.show', $page) }}"
                           class="flex h-full min-w-0 flex-col items-center rounded-2xl border border-nord-4 bg-nord-6 p-5 text-center shadow-sm transition hover:-translate-y-0.5 hover:border-nord-9 hover:shadow-md">
                            <x-avatar :name="$page->full_name" :src="$page->portrait_url" size="lg" />
                            <h3 class="mt-3 w-full break-words font-serif text-lg font-semibold text-nord-0">{{ $page->full_name }}</h3>
                            <p class="mt-0.5 w-full break-words text-sm text-nord-3">{{ $page->lifespan }}</p>
                            @if ($page->birth_place)
                                <p class="w-full break-words text-xs text-nord-3">{{ $page->birth_place }}</p>
                            @endif
                            <p class="mt-3 text-xs text-nord-3">
                                {{ $page->memories_count }} minder · {{ $page->photos_count }} billeder
                            </p>
                        </a>
                    </li>
                @endforeach
            </ul>

            {{ $results->links() }}
        @endif
    </div>
</div>
