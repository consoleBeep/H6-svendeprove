<?php

namespace App\Http\Controllers;

use App\Models\MemorialPage;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function destroy(Photo $photo): RedirectResponse
    {
        $this->authorize('delete', $photo);

        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        return redirect()
            ->route('memorial-pages.show', $photo->memorial_page_id)
            ->with('status', 'Billedet er fjernet.');
    }
}
