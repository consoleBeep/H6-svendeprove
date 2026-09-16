<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function mount(): void
    {
        $redirect = (string) request()->query('redirect', '');

        if (str_starts_with($redirect, '/') && ! str_starts_with($redirect, '//')) {
            session(['url.intended' => $redirect]);
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="E-mail" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Adgangskode" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-nord-4 text-nord-10 shadow-sm focus:ring-nord-10" name="remember">
                <span class="ms-2 text-sm text-nord-2">Husk mig</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="rounded-md text-sm text-nord-3 underline hover:text-nord-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-nord-10" href="{{ route('password.request') }}" wire:navigate>
                    Glemt din adgangskode?
                </a>
            @endif

            <x-primary-button class="ms-3">
                Log ind
            </x-primary-button>
        </div>
    </form>

    <p class="mt-6 text-center text-sm text-nord-3">
        Har du ikke en bruger?
        <a href="{{ route('register', request()->query('redirect') ? ['redirect' => request()->query('redirect')] : []) }}"
           wire:navigate class="font-medium text-nord-10 underline hover:text-nord-9">
            Opret en her
        </a>
    </p>
</div>
