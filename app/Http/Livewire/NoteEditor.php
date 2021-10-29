<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class NoteEditor extends Component
{
    public $note;
    public $for_today = false;

    protected $rules = [
        'note.content' => 'nullable',
    ];

    public function save()
    {
        $this->validate();
        $this->note->save();
    }

    public function mount()
    {
        // Note: How to set the tz here?
        $this->for_today = Carbon::now('America/Los_Angeles')->toDateString() === $this->note->for_date->toDateString();
    }

    public function render()
    {
        return view('livewire.note-editor');
    }
}
