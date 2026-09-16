@php
    /** @var \App\Models\MemorialPage|null $memorialPage */
    $memorialPage ??= null;
@endphp

<div class="space-y-4">
    <div>
        <label for="full_name" class="block text-sm font-medium text-nord-2">Fulde navn</label>
        <input type="text" name="full_name" id="full_name" required maxlength="255"
               value="{{ old('full_name', $memorialPage?->full_name) }}"
               class="mt-1 block w-full rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10">
        <x-input-error :messages="$errors->get('full_name')" class="mt-1" />
    </div>

    <div>
        <label for="profile_photo" class="block text-sm font-medium text-nord-2">Profilbillede</label>
        <div class="mt-1 flex items-center gap-4">
            <x-avatar :name="$memorialPage?->full_name ?? '?'" :src="$memorialPage?->portrait_url" size="lg" />
            <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                   class="block w-full min-w-0 text-sm text-nord-2 file:mr-3 file:rounded-full file:border-0 file:bg-nord-5 file:px-4 file:py-2 file:text-sm file:font-medium hover:file:bg-nord-4">
        </div>
        <x-input-error :messages="$errors->get('profile_photo')" class="mt-1" />
        @if ($memorialPage?->profile_photo_path)
            <p class="mt-1 text-xs text-nord-3">Upload et nyt billede for at erstatte det nuværende.</p>
        @endif
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="birth_date" class="block text-sm font-medium text-nord-2">Fødselsdato</label>
            <input type="date" name="birth_date" id="birth_date"
                   value="{{ old('birth_date', $memorialPage?->birth_date?->format('Y-m-d')) }}"
                   class="mt-1 block w-full rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10">
            <x-input-error :messages="$errors->get('birth_date')" class="mt-1" />
        </div>
        <div>
            <label for="birth_place" class="block text-sm font-medium text-nord-2">Fødested</label>
            <input type="text" name="birth_place" id="birth_place" maxlength="255"
                   value="{{ old('birth_place', $memorialPage?->birth_place) }}"
                   placeholder="F.eks. Odense"
                   class="mt-1 block w-full rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10">
            <x-input-error :messages="$errors->get('birth_place')" class="mt-1" />
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="death_date" class="block text-sm font-medium text-nord-2">Dødsdato</label>
            <input type="date" name="death_date" id="death_date"
                   value="{{ old('death_date', $memorialPage?->death_date?->format('Y-m-d')) }}"
                   class="mt-1 block w-full rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10">
            <x-input-error :messages="$errors->get('death_date')" class="mt-1" />
        </div>
        <div>
            <label for="death_place" class="block text-sm font-medium text-nord-2">Dødssted</label>
            <input type="text" name="death_place" id="death_place" maxlength="255"
                   value="{{ old('death_place', $memorialPage?->death_place) }}"
                   placeholder="F.eks. Aarhus"
                   class="mt-1 block w-full rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10">
            <x-input-error :messages="$errors->get('death_place')" class="mt-1" />
        </div>
    </div>

    <div>
        <label for="grave_location" class="block text-sm font-medium text-nord-2">Gravsted</label>
        <input type="text" name="grave_location" id="grave_location" maxlength="255"
               value="{{ old('grave_location', $memorialPage?->grave_location) }}"
               placeholder="F.eks. Vestre Kirkegård, Aarhus"
               class="mt-1 block w-full rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10">
        <x-input-error :messages="$errors->get('grave_location')" class="mt-1" />
    </div>

    <div>
        <label for="life_story" class="block text-sm font-medium text-nord-2">Livshistorie</label>
        <textarea name="life_story" id="life_story" rows="8"
                  class="mt-1 block w-full rounded-lg border-nord-4 shadow-sm focus:border-nord-10 focus:ring-nord-10">{{ old('life_story', $memorialPage?->life_story) }}</textarea>
        <x-input-error :messages="$errors->get('life_story')" class="mt-1" />
    </div>
</div>
