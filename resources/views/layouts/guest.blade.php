<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mindeplatform') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|fraunces:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-nord-1 antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-nord-5 px-4 py-10">
            <a href="{{ route('home') }}" class="font-serif text-xl font-semibold tracking-tight text-nord-0">
                Mindeplatform
            </a>

            <div class="mt-6 w-full overflow-hidden rounded-2xl border border-nord-4 bg-nord-6 px-6 py-6 shadow-sm sm:max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
