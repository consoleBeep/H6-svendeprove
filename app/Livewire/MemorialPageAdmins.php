<?php

namespace App\Livewire;

use App\Models\MemorialPage;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class MemorialPageAdmins extends Component
{
    public MemorialPage $memorialPage;

    public string $query = '';

    public function addAdmin(int $userId): void
    {
        Gate::authorize('manageAdmins', $this->memorialPage);

        $this->memorialPage->admins()->syncWithoutDetaching(User::findOrFail($userId));

        $this->query = '';
    }

    public function removeAdmin(int $userId): void
    {
        Gate::authorize('manageAdmins', $this->memorialPage);

        $this->memorialPage->admins()->detach($userId);
    }

    public function render(): View
    {
        $term = trim($this->query);
        $results = collect();

        if ($term !== '') {
            $excludedIds = $this->memorialPage->admins()
                ->pluck('users.id')
                ->push($this->memorialPage->user_id);

            $like = '%'.mb_strtolower($term).'%';

            $results = User::query()
                ->whereNotIn('id', $excludedIds)
                ->where(fn ($query) => $query
                    ->whereRaw('lower(name) like ?', [$like])
                    ->orWhereRaw('lower(email) like ?', [$like]))
                ->orderBy('name')
                ->limit(8)
                ->get();
        }

        return view('livewire.memorial-page-admins', [
            'admins' => $this->memorialPage->admins()->orderBy('name')->get(),
            'results' => $results,
        ]);
    }
}
