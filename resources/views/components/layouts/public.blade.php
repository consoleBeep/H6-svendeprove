@props(['title' => null, 'width' => 'default'])

@php
    $containerWidth = match ($width) {
        'wide' => 'max-w-6xl',
        'profile' => 'max-w-4xl',
        default => 'max-w-3xl',
    };
@endphp

<!DOCTYPE html>
<html lang="da" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title.' — Mindeplatform' : 'Mindeplatform' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|fraunces:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="flex min-h-full flex-col bg-nord-5 font-sans text-nord-1 antialiased">
    <header class="sticky top-0 z-20 border-b border-nord-4 bg-nord-5/85 backdrop-blur"
             x-data="{ menuOpen: false }" @keydown.escape.window="menuOpen = false">
        <div class="mx-auto flex w-full max-w-6xl items-center justify-between px-4 py-3.5 sm:py-4">
            <a href="{{ route('home') }}" class="font-serif text-xl font-semibold tracking-tight text-nord-0">
                Mindeplatform
            </a>

            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('memorial-pages.create') }}"
                       class="inline-flex items-center gap-1.5 rounded-full bg-nord-10 px-3.5 py-2 text-sm font-medium text-white transition hover:bg-nord-9">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 5a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 1 1 0-2h3V6a1 1 0 0 1 1-1Z"/>
                        </svg>
                        <span class="hidden sm:inline">Opret mindeside</span>
                        <span class="sm:hidden">Opret</span>
                    </a>
                @endauth

                {{-- Menu: same trigger + panel at every width --}}
                <div class="relative">
                    <button type="button" @click="menuOpen = !menuOpen" :aria-expanded="menuOpen.toString()" aria-label="Menu"
                            class="flex items-center gap-2 rounded-full border border-nord-4 bg-nord-6 py-1.5 pl-1.5 pr-2.5 transition hover:bg-nord-5">
                        @auth
                            <x-avatar :name="auth()->user()->name" :src="auth()->user()->avatar_url" size="sm" />
                        @else
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-nord-5 text-nord-3">
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                    <path d="M4 5h12M4 10h12M4 15h12" stroke-linecap="round"/>
                                </svg>
                            </span>
                        @endauth
                        <svg class="h-3.5 w-3.5 text-nord-3 transition" :class="menuOpen && 'rotate-180'" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <nav x-show="menuOpen" x-cloak x-transition.origin.top.right
                         @click.outside="menuOpen = false" @click="menuOpen = false"
                         class="absolute right-0 mt-2 w-60 overflow-hidden rounded-2xl border border-nord-4 bg-nord-6 py-1.5 text-sm shadow-lg">
                        @auth
                            <div class="flex items-center gap-2.5 border-b border-nord-4 px-4 py-3">
                                <x-avatar :name="auth()->user()->name" :src="auth()->user()->avatar_url" size="sm" />
                                <span class="min-w-0 truncate font-medium text-nord-1">{{ auth()->user()->name }}</span>
                            </div>
                        @endauth

                        <a href="{{ route('home') }}" class="block px-4 py-2.5 text-nord-2 transition hover:bg-nord-5">Søg efter mindesider</a>

                        @auth
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-nord-2 transition hover:bg-nord-5">Din side</a>
                            <a href="{{ route('profile') }}" class="block px-4 py-2.5 text-nord-2 transition hover:bg-nord-5">Kontoindstillinger</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-nord-4">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2.5 text-left text-nord-11 transition hover:bg-nord-5">
                                    Log ud
                                </button>
                            </form>
                        @else
                            <div class="border-t border-nord-4">
                                <a href="{{ route('login') }}" class="block px-4 py-2.5 text-nord-2 transition hover:bg-nord-5">Log ind</a>
                                <a href="{{ route('register') }}" class="block px-4 py-2.5 font-medium text-nord-10 transition hover:bg-nord-5">Opret bruger</a>
                            </div>
                        @endauth
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main class="mx-auto w-full flex-1 px-4 pb-16 pt-6 sm:pt-10 {{ $containerWidth }}">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-nord-14 bg-nord-14/20 px-4 py-3 text-center text-sm text-nord-1">
                {{ session('status') }}
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="border-t border-nord-4 px-4 py-8 text-center text-xs text-nord-3">
        Mindeplatform — et sted at gemme og dele livshistorier.
    </footer>

    @livewireScripts
</body>
</html>
