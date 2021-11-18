<?php

namespace App\View\Requisition;

use App\Contracts\Requisition\CreateRequisition;
use App\Models\Person;
use Livewire\Component;

class Create extends Component
{
    public $state;
    public $type ;
    public $creating =false;
    public $person ;
    public function mount($type,$person)
    {
        $this->type = $type;
        $this->person = $person;
        $this->state = [
            "type"=>$type,
            "destination" => "",
            "authorized_tasks" => "",
            "person_id" => $person->id,
        ];
    }

    public function startCreateRequisition()
    {
        $this->creating = true;
    }

    public function closeCreateRequisition()
    {
        $this->creating = false;
    }


    public function save(CreateRequisition $creator)
    {
        if ( ! ($this->person) ) return;
        $creator->create($this->state,$this->type , $this->person);
        $this->closeCreateRequisition();
        $this->emit("requisitionAdded");
    }

    public function render()
    {
        return view('requisition.create');
    }
}
