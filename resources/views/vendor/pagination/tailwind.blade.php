@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="mt-6">

        {{-- Mobile: just prev/next --}}
        <div class="flex items-center justify-between gap-2 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="rounded-full border border-nord-4 bg-nord-6 px-4 py-2 text-sm font-medium text-nord-3">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="rounded-full border border-nord-4 bg-nord-6 px-4 py-2 text-sm font-medium text-nord-1 transition hover:bg-nord-5">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="rounded-full border border-nord-4 bg-nord-6 px-4 py-2 text-sm font-medium text-nord-1 transition hover:bg-nord-5">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="rounded-full border border-nord-4 bg-nord-6 px-4 py-2 text-sm font-medium text-nord-3">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- Desktop: page numbers + result count --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between sm:gap-4">
            <p class="text-sm text-nord-3">
                {{ __('Showing') }}
                <span class="font-medium text-nord-1">{{ $paginator->firstItem() }}</span>
                {{ __('to') }}
                <span class="font-medium text-nord-1">{{ $paginator->lastItem() }}</span>
                {{ __('of') }}
                <span class="font-medium text-nord-1">{{ $paginator->total() }}</span>
                {{ __('results') }}
            </p>

            <div class="flex items-center gap-1">
                @if ($paginator->onFirstPage())
                    <span class="flex h-9 w-9 items-center justify-center rounded-full text-nord-3">‹</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       class="flex h-9 w-9 items-center justify-center rounded-full text-nord-2 transition hover:bg-nord-5">‹</a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="flex h-9 w-9 items-center justify-center text-sm text-nord-3">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                      class="flex h-9 w-9 items-center justify-center rounded-full bg-nord-10 text-sm font-medium text-white">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                                   class="flex h-9 w-9 items-center justify-center rounded-full text-sm text-nord-2 transition hover:bg-nord-5">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                       class="flex h-9 w-9 items-center justify-center rounded-full text-nord-2 transition hover:bg-nord-5">›</a>
                @else
                    <span class="flex h-9 w-9 items-center justify-center rounded-full text-nord-3">›</span>
                @endif
            </div>
        </div>
    </nav>
@endif
