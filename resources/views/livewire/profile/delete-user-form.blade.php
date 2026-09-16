<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-nord-0">
            Slet konto
        </h2>

        <p class="mt-1 text-sm text-nord-3">
            Når din konto slettes, bliver alt indhold og data permanent slettet. Download eventuelle data,
            du ønsker at beholde, inden du sletter din konto.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Slet konto</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">

            <h2 class="text-lg font-medium text-nord-0">
                Er du sikker på, at du vil slette din konto?
            </h2>

            <p class="mt-1 text-sm text-nord-3">
                Når din konto slettes, bliver alt indhold og data permanent slettet.
                Indtast din adgangskode for at bekræfte, at du vil slette din konto permanent.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Adgangskode" class="sr-only" />

                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Adgangskode"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Annuller
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Slet konto
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
