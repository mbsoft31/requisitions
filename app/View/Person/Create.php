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

    public $show = true;

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
    }

    public function render()
    {
        return view('person.create');
    }
}
