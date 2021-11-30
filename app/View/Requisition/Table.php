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

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $columns = ['id', 'first_name','last_name'];

    protected $listeners = [
        "personUpdated" => '$refresh',
        "personCreated" => '$refresh',
        "personDeleted" => '$refresh',
        "requisitionUpdated" => '$refresh',
        "requisitionDeleted" => '$refresh',
    ];

    public function updatedSearch($value)
    {
        $this->page = 1;
        $this->render();
        /*if (Auth::id() == 1)
            dd($value, $this->page);*/
    }

    public function deleteRequisition(Requisition $requisition)
    {
        if ($requisition)
            $requisition->delete();
        $this->emit('requisitionDeleted');
    }

    public function render()
    {
        $query = Person::query();

        if ( Auth::user()->cannot('manage requisitions') )
            $query->where('user_id', Auth::id());
        if (strlen($this->search)>0){
            $query->orWhere('id', 'LIKE', '%' . $this->search . '%')
                ->orWhere('first_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $this->search . '%');
        }

        return view('requisition.table', ["requisitions" => $query->paginate(5)]);
    }
}
