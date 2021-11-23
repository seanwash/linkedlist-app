<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class NoteController extends Controller
{
    public function index(Request $request): Response
    {
        $daily_notes = Auth::user()
            ->notes()
            ->whereNotNull('for_date')
            ->orderByDesc('for_date')
            ->get();

        return Inertia::render('home', ['daily_notes' => $daily_notes]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'for_date' => 'nullable'
        ]);

        $note = Auth::user()->notes()->create([
            'title' => $request->input('title'),
            'for_date' => $request->input('for_date'),
        ]);

        return redirect()->route('notes.show', $note);
    }

    public function show(Note $note): Response
    {
        return Inertia::render('notes/show', ['note' => $note]);
    }

    public function update(Note $note, Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
        ]);

        $note->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return back();
    }
}
