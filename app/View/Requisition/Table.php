<?php

namespace App\View\Requisition;

use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{

    use WithPagination;

    public function render()
    {
        $requisitions = Person::paginate(6);
        return view('requisition.table', compact("requisitions"));
    }
}
