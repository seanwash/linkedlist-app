<?php

namespace App\Http\Livewire;

use App\Models\Note;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class NoteEditor extends Component
{
    public Note $note;
    public bool $for_today = false;

    protected array $rules = [
        'note.content' => 'nullable',
    ];

    public function save(): void
    {
        $this->validate();
        $this->note->save();
    }

    public function mount(): void
    {
        // Note: How to set the tz here?
        $this->for_today = Carbon::now('America/Los_Angeles')->toDateString() === $this->note->for_date->toDateString();
    }

    public function render(): View
    {
        return view('livewire.note-editor');
    }
}
