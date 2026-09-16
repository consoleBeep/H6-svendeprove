<?php

namespace App\Http\Controllers;

use App\Models\MemorialPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MemorialPageController extends Controller
{
    public function show(MemorialPage $memorialPage): View
    {
        $memorialPage->load('user');

        $memories = $memorialPage->memories()
            ->withCount('comments')
            ->with('user')
            ->paginate(5, pageName: 'minder')
            ->withQueryString();

        $photos = $memorialPage->photos()
            ->paginate(12, pageName: 'billeder')
            ->withQueryString();

        return view('memorial-pages.show', [
            'memorialPage' => $memorialPage,
            'memories' => $memories,
            'photos' => $photos,
        ]);
    }

    public function create(): View
    {
        return view('memorial-pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $memorialPage = $request->user()->memorialPages()->make($this->validateData($request));
        $this->syncProfilePhoto($request, $memorialPage);
        $memorialPage->save();

        return redirect()
            ->route('memorial-pages.show', $memorialPage)
            ->with('status', 'Mindesiden er oprettet.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'max:5120'],
            'birth_date' => ['nullable', 'date'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'death_date' => ['nullable', 'date', 'after_or_equal:birth_date'],
            'death_place' => ['nullable', 'string', 'max:255'],
            'grave_location' => ['nullable', 'string', 'max:255'],
            'life_story' => ['nullable', 'string'],
        ]);
    }

    private function syncProfilePhoto(Request $request, MemorialPage $memorialPage): void
    {
        if (! $request->hasFile('profile_photo')) {
            return;
        }

        $this->deleteProfilePhoto($memorialPage);

        $memorialPage->profile_photo_path = $request->file('profile_photo')->store('portraits', 'public');
    }

    private function deleteProfilePhoto(MemorialPage $memorialPage): void
    {
        if ($memorialPage->profile_photo_path) {
            Storage::disk('public')->delete($memorialPage->profile_photo_path);
        }
    }
}
