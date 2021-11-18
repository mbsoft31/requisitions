<?php

namespace App\View\Person;

use App\Models\Person;
use App\Models\Requisition;
use Livewire\Component;

class Edit extends Component
{
    protected $listeners = [
        "openEditForm" => "openEditForm",
        "closeEditForm" => "closeEditForm",
        "requisitionDeleted" => '$refresh',
        "requisitionAdded" => 'requisitionAdded',
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

    public function requisitionAdded()
    {
        return
        $this->person->refresh();
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
        $requisition->delete();
        $this->person->refresh();
//        $this->emit("requisitionDeleted");
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
