<?php

namespace App\View\Person;

use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Delete extends Component
{
    protected $listeners = [
        'openDeleteConfirmation'=>'openDeleteConfirmation'
    ];
    public $show = false ;
    public $person ;

    public function openDeleteConfirmation(Person $person)
    {
        $this->show = true ;
        $this->person = $person ;
    }
    public function closeDeleteConfirmation()
    {
        $this->show = false ;
    }

    public function deletePerson()
    {
        if (is_null($this->person)) return;
        if (Auth::user()->cannot('manage requisitions') and $this->person->user_id !== Auth::id() ) return ;
        $this->person->requisitions()->delete();
        $this->person->delete();
        $this->closeDeleteConfirmation();
        $this->emit('personDeleted');
    }


    public function render()
    {
        return view('person.delete');
    }
}
