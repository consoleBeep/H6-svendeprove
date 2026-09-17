<section class="rounded-2xl border border-nord-4 bg-nord-6 p-5 sm:p-6">
    <h2 class="font-serif text-lg font-semibold text-nord-0">Administratorer</h2>
    <p class="mt-1 text-sm text-nord-3">
        Administratorer kan redigere mindesiden og fjerne minder, kommentarer og billeder.
        Kun du som ejer kan tilføje eller fjerne administratorer og slette hele siden.
    </p>

    <ul class="mt-4 divide-y divide-nord-4">
        <li class="flex items-center gap-2.5 py-2.5">
            <x-avatar :name="$memorialPage->user->name" :src="$memorialPage->user->avatar_url" size="sm" class="shrink-0" />
            <span class="min-w-0 truncate text-sm">
                <span class="font-medium text-nord-1">{{ $memorialPage->user->name }}</span>
                <span class="text-nord-3">· ejer</span>
            </span>
        </li>
        @foreach ($admins as $admin)
            <li class="flex items-center gap-2.5 py-2.5" wire:key="admin-{{ $admin->id }}">
                <x-avatar :name="$admin->name" :src="$admin->avatar_url" size="sm" class="shrink-0" />
                <span class="min-w-0 flex-1 truncate text-sm">
                    <span class="font-medium text-nord-1">{{ $admin->name }}</span>
                    <span class="text-nord-3">· {{ $admin->email }}</span>
                </span>
                <button type="button" wire:click="removeAdmin({{ $admin->id }})"
                        wire:confirm="Fjern {{ $admin->name }} som administrator?"
                        class="shrink-0 text-xs font-medium text-nord-11 hover:underline">
                    Fjern
                </button>
            </li>
        @endforeach
    </ul>

    {{-- Search & add --}}
    <div class="relative mt-4">
        <label for="admin-search" class="block text-sm font-medium text-nord-2">Tilføj administrator</label>
        <input id="admin-search" type="text" wire:model.live.debounce.300ms="query"
               placeholder="Søg efter navn eller e-mail…" autocomplete="off"
               class="mt-1 block w-full rounded-lg border-nord-4 text-sm focus:border-nord-10 focus:ring-nord-10">

        @if (trim($query) !== '')
            <ul class="absolute z-10 mt-1 max-h-64 w-full overflow-y-auto rounded-lg border border-nord-4 bg-nord-6 shadow-lg">
                @forelse ($results as $user)
                    <li wire:key="result-{{ $user->id }}">
                        <button type="button" wire:click="addAdmin({{ $user->id }})"
                                class="flex w-full items-center gap-2.5 px-3 py-2 text-left transition hover:bg-nord-5">
                            <x-avatar :name="$user->name" :src="$user->avatar_url" size="sm" />
                            <span class="min-w-0 flex-1 truncate text-sm">
                                <span class="font-medium text-nord-1">{{ $user->name }}</span>
                                <span class="text-nord-3">· {{ $user->email }}</span>
                            </span>
                        </button>
                    </li>
                @empty
                    <li class="px-3 py-2 text-sm text-nord-3">Ingen brugere matcher "{{ $query }}".</li>
                @endforelse
            </ul>
        @endif
    </div>
</section>
