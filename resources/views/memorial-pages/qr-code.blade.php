<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            QR-kode &mdash; {{ $memorialPage->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('memorial-pages.show', $memorialPage) }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; {{ $memorialPage->full_name }}</a>

            <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
                <img src="{{ route('memorial-pages.qr.svg', $memorialPage) }}"
                     alt="QR-kode til {{ $memorialPage->full_name }}s mindeside"
                     class="mx-auto h-48 w-48">

                <p class="mt-4 font-semibold text-gray-800">{{ $memorialPage->full_name }}</p>
                <p class="mt-2 text-xs text-gray-500 break-all">{{ $url }}</p>

                <a href="{{ route('memorial-pages.qr.png', $memorialPage) }}"
                   class="mt-6 inline-block rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Download PNG
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
