<?php

namespace App\View\Requisition;

use App\Exports\RequisitionsExport;
use App\Models\Person;
use App\Models\Requisition;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;

class Index extends Component
{
    protected $listeners = [
        'exportAllToExcel'=>'exportAllToExcel',
        "downloadDocument"=>"downloadDocument",
//        'importAllFromExcel'=>'exportAllToExcel',
//        'exportRequisition'=>'exportRequisition',

    ];

    public function exportAllToExcel()
    {
        if(\Auth::user()->cannot('export/import')) return ;
        return Excel::download(new RequisitionsExport,'users.xlsx');
    }

    public function downloadDocument(array $requisitionsIds = null)
    {
        if(\Auth::user()->cannot('export/import')) return ;
        $templateProcessor = new TemplateProcessor(public_path('templates/req_template.docx'));
        $replacements = [];
        if ($requisitionsIds)
            $requisitions = Requisition::whereIn('id',$requisitionsIds)->get();
        else
            $requisitions = Requisition::all();

        $requisitions->map(function ($requisition)use (&$replacements){
            $replacements[] = [
                "id" => $requisition->id,
                "requisition_date" => Carbon::now()->format('Y-m-d'),
                "full_name" => $requisition->person->first_name. ' ' . $requisition->person->last_name,
                "type" => Requisition::$types[$requisition->type],
                "rank" => Person::$ranks[$requisition->person->rank],
                "category" => Person::$classes[$requisition->person->rank],
            ];
        });
//        dd($requisitions);
        $templateProcessor->cloneBlock('requisition_block', 0, true, false, $replacements);
        $templateProcessor->saveAs(public_path('templates/req_output.docx'));
        return response()->download(public_path('templates/req_output.docx'));
    }

    public function render()
    {
        return view('requisition.index');
    }
}
