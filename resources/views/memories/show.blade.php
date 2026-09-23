<x-layouts.public :title="$memory->title ?? ('Minde om '.$memorialPage->full_name)">
    <a href="{{ route('memorial-pages.show', $memorialPage) }}"
       class="inline-flex min-w-0 max-w-full items-center gap-1.5 text-sm font-medium text-nord-3 transition hover:text-nord-1">
        <svg class="h-4 w-4 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 0 1 0 1.06L9.06 10l3.73 3.71a.75.75 0 1 1-1.06 1.06l-4.25-4.24a.75.75 0 0 1 0-1.06l4.25-4.24a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/></svg>
        <span class="min-w-0 truncate">{{ $memorialPage->full_name }}</span>
    </a>

    <article class="mt-4 rounded-2xl border border-nord-4 bg-nord-6 p-5 sm:p-6">
        <div class="flex items-start justify-between gap-3">
            <div class="flex min-w-0 items-center gap-3">
                <x-avatar :name="$memory->user->name" :src="$memory->user->avatar_url" size="md" />
                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-nord-1">{{ $memory->user->name }}</p>
                    <p class="text-xs text-nord-3">{{ $memory->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>

            <div class="flex shrink-0 items-center gap-2 text-sm">
                @can('update', $memory)
                    <a href="{{ route('memorial-pages.memories.edit', [$memorialPage, $memory]) }}"
                       class="rounded-full border border-nord-4 px-3 py-1 font-medium transition hover:bg-nord-5">Rediger</a>
                @endcan
                @can('delete', $memory)
                    <x-delete-form :action="route('memorial-pages.memories.destroy', [$memorialPage, $memory])" confirm="Slet mindet?"
                        class="rounded-full px-3 py-1 font-medium text-nord-11 transition hover:bg-nord-11/10">
                        Slet
                    </x-delete-form>
                @endcan
            </div>
        </div>

        @if ($memory->title)
            <h1 class="mt-4 break-words font-serif text-2xl font-semibold text-nord-0">{{ $memory->title }}</h1>
        @endif
        <div class="mt-3 whitespace-pre-line break-words text-[15px] leading-relaxed text-nord-2">{{ $memory->content }}</div>
    </article>

    {{-- Comments --}}
    <section class="mt-8">
        <h2 class="text-sm font-semibold uppercase tracking-widest text-nord-3">
            Kommentarer · {{ $comments->total() }}
        </h2>

        <ul class="mt-4 space-y-3">
            @forelse ($comments as $comment)
                <li class="flex gap-3 rounded-xl border border-nord-4 bg-nord-6 p-4">
                    <x-avatar :name="$comment->user->name" :src="$comment->user->avatar_url" size="sm" class="mt-0.5" />
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-3">
                            <p class="min-w-0 truncate text-xs text-nord-3">
                                <span class="font-medium text-nord-2">{{ $comment->user->name }}</span>
                                · {{ $comment->created_at->format('d.m.Y H:i') }}
                            </p>
                            @can('delete', $comment)
                                <x-delete-form :action="route('comments.destroy', $comment)" confirm="Slet kommentaren?"
                                    form-class="shrink-0" class="text-xs font-medium text-nord-11 hover:underline">
                                    Slet
                                </x-delete-form>
                            @endcan
                        </div>
                        <p class="mt-1 whitespace-pre-line break-words text-sm text-nord-2">{{ $comment->content }}</p>
                    </div>
                </li>
            @empty
                <li class="py-6 text-center text-sm text-nord-3">Ingen kommentarer endnu.</li>
            @endforelse
        </ul>

        {{ $comments->links() }}

        @auth
            <form id="comment-form" method="POST" action="{{ route('memories.comments.store', $memory) }}" class="mt-5 flex gap-3">
                <x-avatar :name="auth()->user()->name" :src="auth()->user()->avatar_url" size="sm" class="mt-1.5" />
                <div class="flex-1">
                    <label for="content" class="sr-only">Skriv en kommentar</label>
                    <textarea name="content" id="content" rows="2" required maxlength="2000" placeholder="Skriv en kommentar…"
                              class="block w-full rounded-xl border-nord-4 text-sm focus:border-nord-10 focus:ring-nord-10">{{ old('content') }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-1" />
                    <button type="submit"
                            class="mt-2 rounded-full bg-nord-10 px-4 py-1.5 text-sm font-medium text-white transition hover:bg-nord-9">
                        Send
                    </button>
                </div>
            </form>
        @else
            <p id="comment-form" class="mt-5 rounded-xl bg-nord-6 px-4 py-3 text-center text-sm text-nord-3 ring-1 ring-nord-4">
                <a href="{{ route('login', ['redirect' => route('memorial-pages.memories.show', [$memorialPage, $memory], absolute: false).'#comment-form']) }}"
                   class="font-medium text-nord-0 hover:underline">Log ind</a>
                for at kommentere.
            </p>
        @endauth
    </section>
</x-layouts.public>
