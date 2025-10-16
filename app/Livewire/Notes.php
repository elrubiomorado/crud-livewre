<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public function render()
    {
        $notes = Note::orderBy("created_at","desc")->paginate(5);
        return view('livewire.notes', compact('notes'));
    }

    public function edit($id){
        $this->dispatch('edit-note', $id);
    }
}
