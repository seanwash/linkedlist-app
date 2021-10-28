<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Note $note)
    {
        //
    }

    public function edit(Note $note)
    {
        //
    }

    public function update(Request $request, Note $note): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required',
        ]);

        $note->update($validated);

        // Append the note's UUID so that the saved note is focused. Note that this assumes that the user should
        // be redirected back to a static list of notes on the dashboard.
        return redirect()->route('dashboard', ['#'.$note->uuid]);
    }

    public function destroy(Note $note)
    {
        //
    }
}
