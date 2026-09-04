<?php

namespace App\Http\Controllers;

use App\Models\MemorialPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemorialPageController extends Controller
{
    public function show(MemorialPage $memorialPage): View
    {
        $memories = $memorialPage->memories()
            ->with('user')
            ->paginate(5, pageName: 'minder')
            ->withQueryString();

        return view('memorial-pages.show', [
            'memorialPage' => $memorialPage,
            'memories' => $memories,
        ]);
    }

    public function create(): View
    {
        return view('memorial-pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $memorialPage = $request->user()->memorialPages()->create($this->validateData($request));

        return redirect()
            ->route('memorial-pages.show', $memorialPage)
            ->with('status', 'Mindesiden er oprettet.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'death_date' => ['nullable', 'date', 'after_or_equal:birth_date'],
            'death_place' => ['nullable', 'string', 'max:255'],
            'grave_location' => ['nullable', 'string', 'max:255'],
            'life_story' => ['nullable', 'string'],
        ]);
    }
}
