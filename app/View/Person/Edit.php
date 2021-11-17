<?php

namespace App\View\Person;

use App\Models\Person;
use Livewire\Component;

class Edit extends Component
{
    protected $listeners = [
        "openEditForm" => "openEditForm",
        "closeEditForm" => "closeEditForm",
    ];

    public $ranks;

    public $state;

    public $show = false;

    public function openEditForm(Person $person)
    {
        $this->show = true;
        $this->state = $person->withoutRelations()->toArray();
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
    }

    public function mount()
    {
        $this->ranks = Person::$ranks;
        $this->state = [];
    }

    public function render()
    {
        return view('person.edit');
    }
}
