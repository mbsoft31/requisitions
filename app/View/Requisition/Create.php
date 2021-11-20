<?php

namespace App\View\Requisition;

use App\Contracts\Requisition\CreateRequisition;
use App\Models\Person;
use Livewire\Component;

class Create extends Component
{
    public $state;
    public $type;
    public $creating = false;

    public function mount($type)
    {
        $this->type = $type;
        $this->state = [
            "type"=>$type,
            "destination" => "",
            "authorized_tasks" => "",
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


    public function save()
    {
        $this->closeCreateRequisition();
        $this->emit("addRequisition",$this->state);
    }

    public function render()
    {
        return view('requisition.create');
    }
}
