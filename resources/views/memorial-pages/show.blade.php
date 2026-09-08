<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $memorialPage->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800">Minder</h3>

                @auth
                    <form method="POST" action="{{ route('memorial-pages.memories.store', $memorialPage) }}" class="mt-4">
                        @csrf
                        <x-input-label for="title" value="Titel" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />

                        <x-input-label for="content" value="Minde" class="mt-4" />
                        <textarea id="content" name="content" rows="4" required class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content') }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />

                        <x-primary-button class="mt-4">Del minde</x-primary-button>
                    </form>
                @endauth

                <div class="mt-6 space-y-4">
                    @forelse ($memories as $memory)
                        <div class="border-t pt-4 first:border-t-0 first:pt-0">
                            <a href="{{ route('memorial-pages.memories.show', [$memorialPage, $memory]) }}" class="block">
                                @if ($memory->title)
                                    <h4 class="font-medium text-gray-800">{{ $memory->title }}</h4>
                                @endif
                                <p class="mt-1 text-sm text-gray-600">{{ $memory->content }}</p>
                            </a>
                            <p class="mt-1 text-xs text-gray-400">{{ $memory->user->name }} &middot; {{ $memory->created_at->format('d/m/Y') }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Der er endnu ikke delt nogen minder.</p>
                    @endforelse
                </div>

                {{ $memories->links() }}
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800">Billeder</h3>

                @auth
                    <form method="POST" action="{{ route('memorial-pages.photos.store', $memorialPage) }}" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <input type="file" name="photo" accept="image/*" required class="block w-full text-sm text-gray-600">
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />

                        <x-input-label for="caption" value="Billedtekst" class="mt-3" />
                        <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full" :value="old('caption')" />
                        <x-input-error :messages="$errors->get('caption')" class="mt-2" />

                        <x-primary-button class="mt-4">Upload billede</x-primary-button>
                    </form>
                @endauth

                <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3">
                    @forelse ($photos as $photo)
                        <img src="{{ $photo->url }}" alt="{{ $photo->caption }}" class="aspect-square w-full rounded-lg object-cover">
                    @empty
                        <p class="col-span-full text-sm text-gray-500">Der er endnu ikke delt nogen billeder.</p>
                    @endforelse
                </div>

                {{ $photos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
