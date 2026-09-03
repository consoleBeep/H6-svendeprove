<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Opret mindeside
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('memorial-pages.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="full_name" value="Fulde navn" />
                        <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name')" required />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="birth_date" value="Fødselsdato" />
                            <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date')" />
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="birth_place" value="Fødested" />
                            <x-text-input id="birth_place" name="birth_place" type="text" class="mt-1 block w-full" :value="old('birth_place')" />
                            <x-input-error :messages="$errors->get('birth_place')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="death_date" value="Dødsdato" />
                            <x-text-input id="death_date" name="death_date" type="date" class="mt-1 block w-full" :value="old('death_date')" />
                            <x-input-error :messages="$errors->get('death_date')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="death_place" value="Dødssted" />
                            <x-text-input id="death_place" name="death_place" type="text" class="mt-1 block w-full" :value="old('death_place')" />
                            <x-input-error :messages="$errors->get('death_place')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="grave_location" value="Gravsted" />
                        <x-text-input id="grave_location" name="grave_location" type="text" class="mt-1 block w-full" :value="old('grave_location')" />
                        <x-input-error :messages="$errors->get('grave_location')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="life_story" value="Livshistorie" />
                        <textarea id="life_story" name="life_story" rows="6" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('life_story') }}</textarea>
                        <x-input-error :messages="$errors->get('life_story')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <x-primary-button>Opret mindeside</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
