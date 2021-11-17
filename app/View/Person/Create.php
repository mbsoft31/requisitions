<?php

namespace App\View\Person;

use App\Models\Person;
use Livewire\Component;

class Create extends Component
{

    protected $listeners = [
        "openCreateForm" => "openCreateForm",
        "closeCreateForm" => "closeCreateForm",
    ];

    public $ranks;

    public $state;

    public $show = false;

    public function openCreateForm()
    {
        $this->show = true;
    }

    public function closeCreateForm()
    {
        $this->show = false;
    }

    public function mount()
    {
        $this->ranks = Person::$ranks;

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
