<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Memory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Memory $memory): RedirectResponse
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $comment = $memory->comments()->make($data);
        $comment->user()->associate($request->user());
        $comment->save();

        return redirect()
            ->route('memorial-pages.memories.show', [$memory->memorial_page_id, $memory])
            ->with('status', 'Din kommentar er tilføjet.');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $this->authorize('delete', $comment);

        $memory = $comment->memory;
        $comment->delete();

        return redirect()
            ->route('memorial-pages.memories.show', $memory)
            ->with('status', 'Kommentaren er slettet.');
    }
}
