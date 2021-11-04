<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(): View
    {
        $notes = Auth::user()
            ->notes()
            ->whereNotNull('for_date')
            ->orderByDesc('for_date')
            ->get();

        return view('notes.index', ['notes' => $notes]);
    }

    public function update(Note $note, Request $request): RedirectResponse
    {
        $request->validate([
            'content' => 'required',
        ]);

        $note->update([
            'content' => $request->input('content'),
        ]);

        return back();
    }
}
