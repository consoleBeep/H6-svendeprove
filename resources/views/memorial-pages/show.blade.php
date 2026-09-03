<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $memorialPage->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                @if ($memorialPage->birth_date || $memorialPage->death_date)
                    <p class="text-gray-600">
                        {{ $memorialPage->birth_date?->format('d/m/Y') }}
                        &mdash;
                        {{ $memorialPage->death_date?->format('d/m/Y') }}
                    </p>
                @endif

                @if ($memorialPage->grave_location)
                    <p class="text-gray-600">{{ $memorialPage->grave_location }}</p>
                @endif

                @if ($memorialPage->life_story)
                    <p class="whitespace-pre-line text-gray-800">{{ $memorialPage->life_story }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
