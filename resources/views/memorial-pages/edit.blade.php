<x-layouts.public :title="'Rediger '.$memorialPage->full_name">
    <h1 class="font-serif text-2xl font-semibold tracking-tight text-nord-0">Rediger mindeside</h1>

    <form method="POST" action="{{ route('memorial-pages.update', $memorialPage) }}" enctype="multipart/form-data"
          class="mt-6 rounded-2xl border border-nord-4 bg-nord-6 p-5 sm:p-6">
        @csrf
        @method('PUT')
        @include('memorial-pages._form')

        <div class="mt-6 flex items-center gap-3">
            <button type="submit"
                    class="rounded-full bg-nord-10 px-5 py-2 text-sm font-medium text-white transition hover:bg-nord-9">
                Gem ændringer
            </button>
            <a href="{{ route('memorial-pages.show', $memorialPage) }}"
               class="text-sm text-nord-3 hover:text-nord-0">Annuller</a>
        </div>
    </form>

    @can('manageAdmins', $memorialPage)
        <div class="mt-8">
            <livewire:memorial-page-admins :memorial-page="$memorialPage" />
        </div>
    @endcan
</x-layouts.public>
