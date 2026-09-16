<x-layouts.public title="Kontoindstillinger">
    <h1 class="font-serif text-2xl font-semibold tracking-tight text-nord-0">Kontoindstillinger</h1>

    <div class="mt-6 space-y-6">
        <div class="rounded-2xl border border-nord-4 bg-nord-6 p-5 sm:p-8">
            <livewire:profile.update-profile-information-form />
        </div>

        <div class="rounded-2xl border border-nord-4 bg-nord-6 p-5 sm:p-8">
            <livewire:profile.update-password-form />
        </div>

        <div class="rounded-2xl border border-nord-4 bg-nord-6 p-5 sm:p-8">
            <livewire:profile.delete-user-form />
        </div>
    </div>
</x-layouts.public>
