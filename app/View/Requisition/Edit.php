<?php

namespace App\View\Requisition;

use App\Models\Requisition;
use Livewire\Component;

class Edit extends Component
{

    protected $listeners = [
        "startEditRequisition" => "startEditRequisition",
        "save" => "save",
    ];

    public $editing = false;

    public $requisition;
    public $state;

    public function startEditRequisition(int $id)
    {
        if ( ! ($this->requisition and $this->requisition->id == $id) ) return;

        $this->editing = true;
    }

    public function save(int $id)
    {
        if ( ! ($this->requisition and $this->requisition->id == $id) ) return;

        $this->requisition->update($this->state);

        $this->editing = false;
        $this->state = [
            "type" => "",
            "destination" => "",
            "authorized_tasks" => "",
            "person_id" => "",
        ];

//        $this->emit("requisitionUpdated",$this->id);
    }

    public function mount(Requisition $requisition)
    {
        $this->requisition = $requisition;
        $this->state = $this->requisition->withoutRelations()->toArray();
    }

    public function render()
    {
        return view('requisition.edit');
    }
}
