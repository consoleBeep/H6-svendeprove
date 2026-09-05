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

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800">Kommentarer</h3>

                <div class="mt-4 space-y-3">
                    @forelse ($comments as $comment)
                        <div class="border-t pt-3 first:border-t-0 first:pt-0">
                            <p class="text-xs text-gray-400">{{ $comment->user->name }} &middot; {{ $comment->created_at->format('d/m/Y H:i') }}</p>
                            <p class="mt-1 text-sm text-gray-700">{{ $comment->content }}</p>

                            @can('delete', $comment)
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="mt-1"
                                      onsubmit="return confirm('Slet kommentaren?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 hover:underline">Slet</button>
                                </form>
                            @endcan
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Ingen kommentarer endnu.</p>
                    @endforelse
                </div>

                {{ $comments->links() }}

                @auth
                    <form method="POST" action="{{ route('memories.comments.store', $memory) }}" class="mt-4">
                        @csrf
                        <label for="content" class="sr-only">Skriv en kommentar</label>
                        <textarea id="content" name="content" rows="2" required maxlength="2000" placeholder="Skriv en kommentar…"
                                  class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content') }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        <x-primary-button class="mt-2">Send</x-primary-button>
                    </form>
                @else
                    <p class="mt-4 text-sm text-gray-500">
                        <a href="{{ route('login') }}" class="font-medium text-gray-800 hover:underline">Log ind</a> for at kommentere.
                    </p>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
