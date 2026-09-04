<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use App\Models\MemorialPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemoryController extends Controller
{
    public function show(MemorialPage $memorialPage, Memory $memory): View
    {
        $memory->load(['user', 'memorialPage']);

        return view('memories.show', [
            'memorialPage' => $memorialPage,
            'memory' => $memory,
        ]);
    }


    public function store(Request $request, MemorialPage $memorialPage): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $memory = $memorialPage->memories()->make($data);
        $memory->user()->associate($request->user());
        $memory->save();

        return redirect()
            ->route('memorial-pages.memories.show', [$memorialPage, $memory])
            ->with('status', 'Mindet er offentliggjort.');
    }
}
