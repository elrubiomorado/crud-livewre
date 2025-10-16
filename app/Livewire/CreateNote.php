<?php

namespace App\Livewire;

use App\Models\Note;
use Flux\Flux;
use Livewire\Component;

class CreateNote extends Component
{
    public $title;
    public $content;

    //validaciones de campos
    protected function rules(){
        return [
            "title"=> "required|string|unique:notes,title|max:255",
            "content"=> "required|string"
        ];
    }

    public function save(){
        //validar campos
        $this->validate();
        //store notes
        Note::create([
            "title"=> $this->title,
            "content"=> $this->content
        ]);
        //Resetear inputs
        $this->reset();
        //close create-modal
        Flux::modal('create-note')->close();
        //display flash message
        session()->flash('success', 'Note Created Succesfull');
        //redirect to notes route
        $this->redirectRoute('notes', navigate:true);
    }
    public function render()
    {
        return view('livewire.create-note');
    }
}
