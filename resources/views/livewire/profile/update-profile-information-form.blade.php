<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';

    /**
     * A newly picked avatar, staged until the form is saved.
     */
    public $avatar = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:5120'],
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($this->avatar) {
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $user->avatar_path = $this->avatar->store('avatars', 'public');
        }

        $user->save();

        $this->avatar = null;

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-nord-0">
            Profiloplysninger
        </h2>

        <p class="mt-1 text-sm text-nord-3">
            Opdater dine kontooplysninger og din e-mailadresse.
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <label class="block text-sm font-medium text-nord-2">Profilbillede</label>
            <div class="mt-1 flex items-center gap-4">
                @if ($avatar)
                    <img src="{{ $avatar->temporaryUrl() }}" alt="" class="h-24 w-24 rounded-full object-cover ring-1 ring-nord-0/10">
                @else
                    <x-avatar :name="$name" :src="auth()->user()->avatar_url" size="lg" />
                @endif
                <label class="cursor-pointer rounded-full border border-nord-4 bg-nord-6 px-3.5 py-2 text-sm font-medium text-nord-2 transition hover:bg-nord-5">
                    <span wire:loading.remove wire:target="avatar">Skift billede</span>
                    <span wire:loading wire:target="avatar">Uploader…</span>
                    <input type="file" wire:model="avatar" accept="image/*" class="sr-only">
                </label>
            </div>
            <x-input-error :messages="$errors->get('avatar')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="name" value="Navn" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="E-mail" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-nord-1">
                        Din e-mailadresse er ikke bekræftet.

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-nord-3 hover:text-nord-0 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-nord-10">
                            Klik her for at sende bekræftelsesmailen igen.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-nord-14">
                            Et nyt bekræftelseslink er sendt til din e-mailadresse.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Gem</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                Gemt.
            </x-action-message>
        </div>
    </form>
</section>
