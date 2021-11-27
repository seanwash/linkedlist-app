<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class NoteController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(Request $request): Response
    {
        $this->authorize('viewAny', Note::class);

        $daily_notes = Auth::user()
            ->notes()
            ->whereNotNull('for_date')
            ->orderByDesc('for_date')
            ->get();

        return Inertia::render('home', ['daily_notes' => $daily_notes]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Note::class);

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

    /**
     * @throws AuthorizationException
     */
    public function show(Note $note): Response
    {
        $this->authorize('view', $note);

        return Inertia::render('notes/show', ['note' => $note]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Note $note, Request $request): RedirectResponse
    {
        $this->authorize('update', $note);

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

    /**
     * @throws AuthorizationException
     */
    public function delete(Note $note, Request $request): \Illuminate\Http\Response|RedirectResponse
    {
        $this->authorize('delete', $note);

        $note->delete();

        if (str_contains(url()->previous(), $note->uuid)) {
            return Inertia::location(RouteServiceProvider::HOME);
        } else {
            return back();
        }
    }
}
