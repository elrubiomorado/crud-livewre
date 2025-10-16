<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
class EditNote extends Component
{
    public $title, $content, $noteId;

    #[On('edit-note')]
    public function editNote($noteId){
        dd('edit-note received with ID: {$id}');
    }
    public function render()
    {
        return view('livewire.edit-note');
    }
}
