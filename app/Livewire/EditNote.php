<?php

namespace App\Livewire;

use App\Models\Note;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\On;
class EditNote extends Component
{
    //Elements of note
    public $title, $content, $id;

    #[On('edit-note')]
    public function editNote($id){
        //Find note by id
        $note = Note::findOrFail($id);
        $this->id = $id;
        $this->title = $note->title;
        $this->content = $note->content;

        //open create-modal
        Flux::modal('edit-note')->show();
    }

    //validaciones de campos
    protected function rules(){
        return [
            "title"=> ['required', 'string', 'max:255', Rule::unique('notes', 'title')->ignore($this->noteId)],
            "content"=> ['required', 'string']
        ];
    }
    public function update(){
        //valite with function rules
        $this->validate();

        //update note
        $note = Note::find($this->id);
        $note->title = $this->title;
        $note->content = $this->content;
        $note->save();

        //close modal
        Flux::modal('edit-note')->close();

        //display flash message
        session()->flash('success', 'Note Update Succesfull');
        
        //redirect to notes route
        $this->redirectRoute('notes', navigate:true);
    }
    public function render()
    {
        return view('livewire.edit-note');
    }
}
