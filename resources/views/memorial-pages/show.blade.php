<x-layouts.public :title="$memorialPage->full_name" width="wide">
    <div class="grid gap-8 lg:grid-cols-[280px_1fr]">
        <aside class="lg:sticky lg:top-6 lg:self-start">
            <div class="rounded-2xl border border-nord-4 bg-nord-6 p-5 text-center">
                <x-avatar :name="$memorialPage->full_name" :src="$memorialPage->portrait_url" size="xl" class="mx-auto" />

                <h1 class="mt-4 font-serif text-xl font-semibold tracking-tight text-nord-0">
                    {{ $memorialPage->full_name }}
                </h1>

                @if ($memorialPage->lifespan)
                    <p class="mt-1 text-sm text-nord-3">{{ $memorialPage->lifespan }}</p>
                @endif

                @if ($memorialPage->birth_date || $memorialPage->death_date || $memorialPage->grave_location)
                    <div class="mt-4 space-y-1.5 rounded-xl border border-nord-4 bg-nord-5/60 p-3 text-left text-sm">
                        @if ($memorialPage->birth_date)
                            <p class="flex items-baseline justify-between gap-2">
                                <span class="shrink-0 text-nord-3">Født:</span>
                                <span class="text-right text-nord-1">
                                    {{ $memorialPage->birth_date->format('d.m.Y') }}
                                    @if ($memorialPage->birth_place) i {{ $memorialPage->birth_place }} @endif
                                </span>
                            </p>
                        @endif

                        @if ($memorialPage->death_date)
                            <p class="flex items-baseline justify-between gap-2">
                                <span class="shrink-0 text-nord-3">Død:</span>
                                <span class="text-right text-nord-1">
                                    {{ $memorialPage->death_date->format('d.m.Y') }}
                                    @if ($memorialPage->death_place) i {{ $memorialPage->death_place }} @endif
                                </span>
                            </p>
                        @endif

                        @if ($memorialPage->grave_location)
                            <p class="flex items-baseline justify-between gap-2 border-t border-nord-4 pt-1.5">
                                <span class="shrink-0 text-nord-3">Begravet:</span>
                                <span class="text-right text-nord-1">{{ $memorialPage->grave_location }}</span>
                            </p>
                        @endif
                    </div>
                @endif

                <div class="mt-4 flex flex-col gap-2">
                    <a href="{{ route('memorial-pages.qr.show', $memorialPage) }}"
                       class="rounded-full border border-nord-4 px-4 py-1.5 text-xs font-medium text-nord-2 transition hover:border-nord-10 hover:text-nord-10">
                        QR-kode
                    </a>

                    @can('update', $memorialPage)
                        <a href="{{ route('memorial-pages.edit', $memorialPage) }}"
                           class="rounded-full border border-nord-4 px-4 py-1.5 text-xs font-medium text-nord-2 transition hover:border-nord-10 hover:text-nord-10">
                            Rediger mindeside
                        </a>
                    @endcan

                    @can('delete', $memorialPage)
                        <x-delete-form :action="route('memorial-pages.destroy', $memorialPage)" confirm="Slet mindesiden? Dette kan ikke fortrydes."
                            class="rounded-full border border-nord-4 px-4 py-1.5 text-xs font-medium text-nord-11 transition hover:border-nord-11">
                            Slet mindeside
                        </x-delete-form>
                    @endcan
                </div>
            </div>

            @if ($memorialPage->life_story)
                <div class="mt-4 rounded-2xl border border-nord-4 bg-nord-6 p-5">
                    <h2 class="font-serif text-sm font-semibold text-nord-0">Livshistorie</h2>
                    <p class="mt-2 whitespace-pre-line text-sm text-nord-2">{{ $memorialPage->life_story }}</p>
                </div>
            @endif
        </aside>

        <div class="space-y-8">
            <section>
                <h2 class="font-serif text-lg font-semibold tracking-tight text-nord-0">Minder</h2>

                @auth
                    <div x-data="{ open: {{ $errors->has('title') || $errors->has('content') ? 'true' : 'false' }} }">
                        <button type="button" @click="open = true"
                                class="mt-4 rounded-full bg-nord-10 px-4 py-1.5 text-sm font-medium text-white transition hover:bg-nord-9">
                            Del minde
                        </button>

                        <div x-show="open" x-cloak @keydown.escape.window="open = false"
                             class="fixed inset-0 z-50 flex items-center justify-center bg-nord-0/50 p-4">
                            <div @click.outside="open = false" class="w-full max-w-md rounded-2xl border border-nord-4 bg-nord-6 p-5">
                                <h3 class="font-serif text-lg font-semibold text-nord-0">Del et minde</h3>

                                <form method="POST" action="{{ route('memorial-pages.memories.store', $memorialPage) }}" class="mt-4">
                                    @csrf
                                    <label for="title" class="sr-only">Titel</label>
                                    <input type="text" name="title" id="title" maxlength="255" placeholder="Titel (valgfri)"
                                           value="{{ old('title') }}"
                                           class="block w-full rounded-lg border-nord-4 text-sm focus:border-nord-10 focus:ring-nord-10">
                                    <x-input-error :messages="$errors->get('title')" class="mt-1" />

                                    <label for="content" class="sr-only">Del et minde</label>
                                    <textarea name="content" id="content" rows="4" required placeholder="Del et minde…"
                                              class="mt-2 block w-full rounded-lg border-nord-4 text-sm focus:border-nord-10 focus:ring-nord-10">{{ old('content') }}</textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-1" />

                                    <div class="mt-3 flex items-center justify-end gap-2">
                                        <button type="button" @click="open = false"
                                                class="rounded-full border border-nord-4 px-4 py-1.5 text-sm font-medium text-nord-2 transition hover:bg-nord-5">
                                            Annuller
                                        </button>
                                        <button type="submit"
                                                class="rounded-full bg-nord-10 px-4 py-1.5 text-sm font-medium text-white transition hover:bg-nord-9">
                                            Del minde
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <div class="mt-4 space-y-4">
                    @forelse ($memories as $memory)
                        <article class="rounded-2xl border border-nord-4 bg-nord-6 p-4">
                            <div class="flex items-center gap-2 text-xs text-nord-3">
                                <span class="font-medium text-nord-2">{{ $memory->user->name }}</span>
                                <span>&middot;</span>
                                <span>{{ $memory->created_at->format('d/m/Y') }}</span>
                            </div>

                            <a href="{{ route('memorial-pages.memories.show', [$memorialPage, $memory]) }}" class="mt-2 block">
                                @if ($memory->title)
                                    <h3 class="font-medium text-nord-0">{{ $memory->title }}</h3>
                                @endif
                                <p class="mt-1 line-clamp-3 text-sm text-nord-2">{{ $memory->content }}</p>
                            </a>

                            <a href="{{ route('memorial-pages.memories.show', [$memorialPage, $memory]) }}"
                               class="mt-2 inline-block text-xs text-nord-3 hover:text-nord-10">
                                {{ $memory->comments_count }} {{ $memory->comments_count === 1 ? 'kommentar' : 'kommentarer' }}
                            </a>
                        </article>
                    @empty
                        <p class="text-sm text-nord-3">Der er endnu ikke delt nogen minder.</p>
                    @endforelse
                </div>

                {{ $memories->links() }}
            </section>

            <section>
                <h2 class="font-serif text-lg font-semibold tracking-tight text-nord-0">Billeder</h2>

                @auth
                    <div x-data="{ open: {{ $errors->has('photo') ? 'true' : 'false' }} }">
                        <button type="button" @click="open = true"
                                class="mt-4 rounded-full bg-nord-10 px-4 py-1.5 text-sm font-medium text-white transition hover:bg-nord-9">
                            Tilføj billede
                        </button>

                        <div x-show="open" x-cloak @keydown.escape.window="open = false"
                             class="fixed inset-0 z-50 flex items-center justify-center bg-nord-0/50 p-4">
                            <div @click.outside="open = false" class="w-full max-w-md rounded-2xl border border-nord-4 bg-nord-6 p-5">
                                <h3 class="font-serif text-lg font-semibold text-nord-0">Tilføj billede</h3>

                                <form method="POST" action="{{ route('memorial-pages.photos.store', $memorialPage) }}" enctype="multipart/form-data" class="mt-4">
                                    @csrf
                                    <label for="photo" class="sr-only">Billede</label>
                                    <input type="file" name="photo" id="photo" accept="image/*" required
                                           class="block w-full text-sm text-nord-2 file:mr-3 file:rounded-full file:border-0 file:bg-nord-5 file:px-4 file:py-2 file:text-sm file:font-medium hover:file:bg-nord-4">
                                    <x-input-error :messages="$errors->get('photo')" class="mt-1" />

                                    <div class="mt-3 flex items-center justify-end gap-2">
                                        <button type="button" @click="open = false"
                                                class="rounded-full border border-nord-4 px-4 py-1.5 text-sm font-medium text-nord-2 transition hover:bg-nord-5">
                                            Annuller
                                        </button>
                                        <button type="submit"
                                                class="rounded-full bg-nord-10 px-4 py-1.5 text-sm font-medium text-white transition hover:bg-nord-9">
                                            Tilføj billede
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
                    @forelse ($photos as $photo)
                        <div class="group relative aspect-square overflow-hidden rounded-xl border border-nord-4">
                            <img src="{{ $photo->url }}" alt="{{ $photo->caption }}" class="h-full w-full object-cover">

                            @can('delete', $photo)
                                <x-delete-form :action="route('photos.destroy', $photo)" confirm="Slet dette billede?"
                                    form-class="absolute right-1.5 top-1.5 opacity-0 transition group-hover:opacity-100"
                                    class="rounded-full bg-nord-0/60 p-1.5 text-white hover:bg-nord-11">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </x-delete-form>
                            @endcan
                        </div>
                    @empty
                        <p class="col-span-full text-sm text-nord-3">Der er endnu ikke delt nogen billeder.</p>
                    @endforelse
                </div>

                {{ $photos->links() }}
            </section>
        </div>
    </div>
</x-layouts.public>
