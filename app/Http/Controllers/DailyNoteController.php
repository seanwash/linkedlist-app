<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DailyNoteController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $latest_note = Note::orderByForDate()->first();

        $note_timestamp = $latest_note
            ? $latest_note->for_date->addDays(1)
            : Carbon::now('America/Los_Angeles');

        $note = Auth::user()->notes()->create([
            'title' => $note_timestamp->toFormattedDateString(),
            'is_pinned' => false,
            'for_date' => $note_timestamp
        ]);

        return back();
    }
}
