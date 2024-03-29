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
        'deleteRequisition'=> 'deleteRequisition',
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
            "requisition_date" => '2021-11-20',
            "birthdate" => '1980-01-01',
            "rank" => "",
            "commission" => "",
        ];
        $this->requisitions = [
            Requisition::$PREPARATION => null,
            Requisition::$MANAGEMENT => null
        ];
    }

    public function addRequisition($inputs)
    {
        $this->requisitions[ $inputs['type'] ] = new Requisition($inputs);
    }

    public function deleteRequisition($requisition)
    {
        if ( ! $this->show ) return;
        $this->requisitions[$requisition['type']] = null ;
    }

    public function store(CreatePerson $creator,CreateRequisition $requisitionCreator)
    {
        $this->person = $creator->create($this->state);
        foreach ($this->requisitions as $type => $requisition) {
            if ($requisition) {
                $requisitionCreator->create($requisition, $type, $this->person);

            }
        }
        $this->emit('personCreated');
        $this->closeCreateForm();
    }

    public function mount()
    {
        $this->ranks = Person::$ranks;
        $this->types = [
            Requisition::$PREPARATION => "preparation_requisition",
            Requisition::$MANAGEMENT  => "management_requisition",
        ];

        $this->state = [
            "first_name" => "",
            "last_name" => "",
            "birth_place" => "",
            "original_job" => "مسخر",
            "requisition_date" => '2021-11-20',
            "birthdate" => '1980-01-01',
            "rank" => 12,
            "commission" => "المندوبية الولائية",
        ];

        $this->requisitions = [
            Requisition::$PREPARATION => null,
            Requisition::$MANAGEMENT => null,
        ];
    }

    public function render()
    {
        return view('person.create');
    }
}
