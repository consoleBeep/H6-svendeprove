<?php

namespace App\Http\Controllers;

use App\Models\MemorialPage;
use App\Models\Memory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemoryController extends Controller
{
    // {memory} is scoped to {memorialPage} in routes/web.php - mismatched pair 404s on its own
    public function show(MemorialPage $memorialPage, Memory $memory): View
    {
        $memory->load(['user', 'memorialPage']);

        $comments = $memory->comments()->with('user')->paginate(10);

        return view('memories.show', [
            'memorialPage' => $memorialPage,
            'memory' => $memory,
            'comments' => $comments,
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

    public function edit(MemorialPage $memorialPage, Memory $memory): View
    {
        $this->authorize('update', $memory);

        return view('memories.edit', [
            'memorialPage' => $memorialPage,
            'memory' => $memory,
        ]);
    }

    public function update(Request $request, MemorialPage $memorialPage, Memory $memory): RedirectResponse
    {
        $this->authorize('update', $memory);

        $memory->update($request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]));

        return redirect()
            ->route('memorial-pages.memories.show', [$memorialPage, $memory])
            ->with('status', 'Mindet er opdateret.');
    }

    public function destroy(MemorialPage $memorialPage, Memory $memory): RedirectResponse
    {
        $this->authorize('delete', $memory);

        $memory->delete();

        return redirect()
            ->route('memorial-pages.show', $memorialPage)
            ->with('status', 'Mindet er slettet.');
    }
}
