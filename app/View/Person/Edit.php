<?php

namespace App\View\Person;

use App\Contracts\Requisition\CreateRequisition;
use App\Models\Person;
use App\Models\Requisition;
use Livewire\Component;

class Edit extends Component
{
    protected $listeners = [
        "openEditForm" => "openEditForm",
        "closeEditForm" => "closeEditForm",
        "requisitionDeleted" => '$refresh',
        "requisitionUpdated" => '$refresh',
        "addRequisition" => 'addRequisition',
        "deleteRequisition" => "deleteRequisition",
    ];

    public $state;
    public $person;

    public $show = false;
    public $ranks;
    public $types;

    public function openEditForm(Person $person)
    {
        $this->show = true;
        $this->state = $person->withoutRelations()->toArray();
        $this->person = $person;
    }

    public function addRequisition($inputs,CreateRequisition $creator)
    {
        $creator->create($inputs,$inputs['type'],$this->person);
        if ($this->person)
            $this->person->refresh();
        $this->emit('requisitionUpdated');
    }

    public function closeEditForm()
    {
        $this->show = false;
        $this->state = [
            "first_name" => "",
            "last_name" => "",
            "birth_place" => "",
            "original_job" => "",
            "birthdate" => "",
            "requisition_date" => "",
            "rank" => "",
            "commission" => "",
        ];
        $this->person = null;
    }

    public function deleteRequisition(Requisition $requisition)
    {
        if (!$this->show)return;
//        dd($requisition);
        $requisition->delete();
        $this->person->refresh();
//        dd($requisition);
        $this->emit("requisitionDeleted");
    }


    public function save()
    {
        if ( ! ($this->person) ) return;
        /*foreach($this->person->requisitions as $requisition)
            $this->emit("save", $requisition->id);*/
        $this->person->update($this->state);
        $this->person->refresh();
        $this->state = $this->person->withoutRelations()->toArray();
        $this->closeEditForm();
        $this->emit('personUpdated');
    }

    public function mount()
    {
        $this->ranks = Person::$ranks;
        $this->types = [
            Requisition::$PREPARATION=>"preparation_requisition",
            Requisition::$MANAGEMENT =>"management_requisition"
        ];
        $this->state = [];
        //$this->openEditForm(Person::first());
    }

    public function render()
    {
        return view('person.edit');
    }
}
