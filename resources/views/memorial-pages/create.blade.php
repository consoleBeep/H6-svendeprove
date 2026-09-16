<x-layouts.public title="Opret mindeside">
    <h1 class="font-serif text-2xl font-semibold tracking-tight text-nord-0">Opret mindeside</h1>
    <p class="mt-1 text-sm text-nord-3">Kun navnet er påkrævet — resten kan tilføjes senere.</p>

    <form method="POST" action="{{ route('memorial-pages.store') }}" enctype="multipart/form-data"
          class="mt-6 rounded-2xl border border-nord-4 bg-nord-6 p-5 sm:p-6">
        @csrf
        @include('memorial-pages._form')

        <div class="mt-6 flex items-center gap-3">
            <button type="submit"
                    class="rounded-full bg-nord-10 px-5 py-2 text-sm font-medium text-white transition hover:bg-nord-9">
                Opret mindeside
            </button>
            <a href="{{ route('home') }}" class="text-sm text-nord-3 hover:text-nord-0">Annuller</a>
        </div>
    </form>
</x-layouts.public>
