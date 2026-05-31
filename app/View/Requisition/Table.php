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
    public $commissions;
    public $commission;
    protected $listeners = [
        "personUpdated" => '$refresh',
        "personCreated" => '$refresh',
        "personDeleted" => '$refresh',
        "requisitionUpdated" => '$refresh',
        "requisitionDeleted" => '$refresh',
    ];
    protected $queryString = [
        'search' => ['except' => ''],
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

    public function mount()
    {
        $this->commission = 0;
    }

    public function render()
    {
        $this->commissions = Person::select('commission')->distinct()->pluck('commission');
        $query = Person::query();
        if (Auth::user()->cannot('manage requisitions'))
            $query->where('user_id', Auth::id());
        if (strlen($this->search)>0){
            foreach($this->columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $this->search . '%');
            }
        }
        if ($this->commission != 0) {
            $query->where('commission', $this->commission);
        }
        return view('requisition.table', ["requisitions" => $query->paginate(6)]);
    }
}
