<?php

namespace App\View\Requisition;

use App\Models\Person;
use App\Models\Requisition;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    protected $listeners = [
        "personUpdated" => '$refresh',
        "personCreated" => '$refresh',
        "requisitionUpdated" => '$refresh',
        "requisitionDeleted" => '$refresh',
    ];

    public function deleteRequisition(Requisition $requisition)
    {
        if ($requisition)
            $requisition->delete();
        $this->emit('requisitionDeleted');
    }

    public function render()
    {
        return view('requisition.table', ["requisitions" => Person::paginate(5)]);
    }
}
