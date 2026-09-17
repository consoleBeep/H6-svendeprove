<x-layouts.public title="Rediger minde">
    <h1 class="font-serif text-2xl font-semibold tracking-tight text-nord-0">Rediger minde</h1>

    <form method="POST" action="{{ route('memorial-pages.memories.update', [$memorialPage, $memory]) }}"
          class="mt-6 space-y-4 rounded-2xl border border-nord-4 bg-nord-6 p-5 sm:p-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-nord-2">Overskrift (valgfri)</label>
            <input type="text" name="title" id="title" maxlength="255"
                   value="{{ old('title', $memory->title) }}"
                   class="mt-1 block w-full rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10">
            <x-input-error :messages="$errors->get('title')" class="mt-1" />
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-nord-2">Minde</label>
            <textarea name="content" id="content" rows="8" required
                      class="mt-1 block w-full rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10">{{ old('content', $memory->content) }}</textarea>
            <x-input-error :messages="$errors->get('content')" class="mt-1" />
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="rounded-full bg-nord-10 px-5 py-2 text-sm font-medium text-white transition hover:bg-nord-9">
                Gem ændringer
            </button>
            <a href="{{ route('memorial-pages.memories.show', [$memorialPage, $memory]) }}"
               class="text-sm text-nord-3 hover:text-nord-0">Annuller</a>
        </div>
    </form>
</x-layouts.public>
