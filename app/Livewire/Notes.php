<?php

namespace App\Livewire;

use App\Models\Note;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public $id;

    public function render()
    {
        $notes = Note::orderBy("created_at","desc")->paginate(5);
        return view('livewire.notes', compact('notes'));
    }

    public function edit($id){
        $this->dispatch('edit-note', $id);
    }

    public function delete($id){
        $this->id = $id;
        Flux::modal('delete-note')->show();
    }

    public function deleteNote(){
        Note::find($this->id)->delete();
        //close modal
        Flux::modal('delete-note')->close();

        //display flash message
        session()->flash('success', 'Note Delete Succesfull');
        
        //redirect to notes route
        $this->redirectRoute('notes', navigate:true);

    }
}
