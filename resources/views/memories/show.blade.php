<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $memory->title ?? 'Minde om '.$memorialPage->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('memorial-pages.show', $memorialPage) }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; {{ $memorialPage->full_name }}</a>

            <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-xs text-gray-400">{{ $memory->user->name }} &middot; {{ $memory->created_at->format('d/m/Y H:i') }}</p>
                <p class="mt-3 whitespace-pre-line text-gray-800">{{ $memory->content }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
