<?php

namespace App\View\Requisition;

use App\Exports\RequisitionsExport;
use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    protected $listeners = [
        'exportAllToExcel'=>'exportAllToExcel',
//        'importAllFromExcel'=>'exportAllToExcel',
//        'exportRequisition'=>'exportAllToExcel',
    ];

    public function exportAllToExcel()
    {
        return Excel::download(new RequisitionsExport,'users.xlsx');
    }
    public function render()
    {
        return view('requisition.index');
    }
}
