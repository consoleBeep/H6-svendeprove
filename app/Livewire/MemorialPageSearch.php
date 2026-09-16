<?php

namespace App\Livewire;

use App\Models\MemorialPage;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MemorialPageSearch extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $query = '';

    public function updatedQuery(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $results = MemorialPage::query()
            ->search($this->query)
            ->withCount(['memories', 'photos'])
            ->orderBy('full_name')
            ->paginate(12);

        return view('livewire.memorial-page-search', [
            'results' => $results,
        ]);
    }
}
