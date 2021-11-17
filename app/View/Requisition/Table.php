<?php

namespace App\View\Requisition;

use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    protected $listeners = [
        "pageChanged" => '$refresh'
    ];

    public function render()
    {
        return view('requisition.table', ["requisitions" => Person::paginate(5)]);
    }
}
