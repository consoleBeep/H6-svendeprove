<?php

namespace App\Http\Controllers;

use App\Models\MemorialPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Request $request, MemorialPage $memorialPage): RedirectResponse
    {
        $data = $request->validate([
            'photo' => ['required', 'image', 'max:5120'],
            'caption' => ['nullable', 'string', 'max:255'],
        ]);

        $path = $request->file('photo')->store('photos', 'public');

        $photo = $memorialPage->photos()->make([
            'path' => $path,
            'caption' => $data['caption'] ?? null,
        ]);
        $photo->user()->associate($request->user());
        $photo->save();

        return redirect()
            ->route('memorial-pages.show', $memorialPage)
            ->with('status', 'Billedet er tilføjet.');
    }
}
