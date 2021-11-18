<?php

namespace App\View\Person;

use App\Contracts\Person\CreatePerson;
use App\Models\Person;
use App\Models\Requisition;
use Livewire\Component;

class Create extends Component
{

    protected $listeners = [
        "openCreateForm" => "openCreateForm",
        "closeCreateForm" => "closeCreateForm",
        "requisitionUpdated" => '$refresh',
        "requisitionDeleted" => '$refresh',
        'saved'=>'$refresh'
    ];

    public $ranks;

    public $state;

    public $show = false;
    public $person ;

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

    public function store(CreatePerson $creator)
    {
        $this->person = $creator->create($this->state);
//        $this->closeCreateForm();
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
    }

    public function render()
    {
        return view('person.create');
    }
}
