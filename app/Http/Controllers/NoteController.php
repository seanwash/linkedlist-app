<?php

namespace App\Http\Controllers;

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
}
