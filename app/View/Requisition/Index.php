<?php

namespace App\View\Requisition;

use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public function render()
    {
        return view('requisition.index', [
            "persons" => Person::paginate(4),
        ]);
    }
}
