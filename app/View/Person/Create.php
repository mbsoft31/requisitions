<?php

namespace App\View\Person;

use App\Contracts\Person\CreatePerson;
use App\Contracts\Requisition\CreateRequisition;
use App\Models\Person;
use App\Models\Requisition;
use Livewire\Component;

class Create extends Component
{

    protected $listeners = [
        "openCreateForm" => "openCreateForm",
        "closeCreateForm" => "closeCreateForm",
        "requisitionUpdated" => '$refresh',
        "addRequisition" => 'addRequisition',
        "requisitionDeleted" => '$refresh',
        'saved'=>'$refresh'
    ];

    public $ranks;

    public $state;

    public $show = false;
    public $person ;
    public $requisitions;
    public $types;

    public function openCreateForm()
    {
        $this->show = true;
    }

    public function closeCreateForm()
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
    }
    public function addRequisition($inputs)
    {
        $this->requisitions[$inputs['type']] = new Requisition($inputs);
    }

    public function store(CreatePerson $creator,CreateRequisition $requisitionCreator)
    {
        $this->person = $creator->create($this->state);
        foreach ($this->requisitions as $type=>$requisition) {
            $requisitionCreator->create($requisition,$type , $this->person);
        }
        $this->closeCreateForm();
    }

    public function mount()
    {
        $this->ranks = Person::$ranks;
        $this->types = [
            Requisition::$PREPARATION=>"preparation_requisition",
            Requisition::$MANAGEMENT =>"management_requisition"
        ];
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
        $this->requisitions = [
            Requisition::$PREPARATION=>null,
            Requisition::$MANAGEMENT=>null
        ];
    }

    public function render()
    {
        return view('person.create');
    }
}
