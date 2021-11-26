<?php

namespace App\View\Requisition;

use App\Models\Person;
use App\Models\Requisition;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public $search = '';
    public $columns = ['first_name','last_name','birth_place','birthdate','commission'];
    protected $listeners = [
        "personUpdated" => '$refresh',
        "personCreated" => '$refresh',
        "personDeleted" => '$refresh',
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
        $query = Person::query();
        if (Auth::user()->cannot('manage requisitions'))
            $query->where('user_id', Auth::id());
        if (strlen($this->search)>2){
            foreach($this->columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $this->search . '%');
            }
        }
        return view('requisition.table', ["requisitions" => $query->paginate(5)]);
    }
}
