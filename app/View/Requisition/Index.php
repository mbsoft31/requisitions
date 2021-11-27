<?php

namespace App\View\Requisition;

use App\Exports\RequisitionsExport;
use App\Models\Person;
use App\Models\Requisition;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;

class Index extends Component
{
    protected $listeners = [
        'exportAllToExcel'=>'exportAllToExcel',
        "downloadDocument"=>"downloadDocuments",
//        'importAllFromExcel'=>'exportAllToExcel',
//        'exportRequisition'=>'exportRequisition',

    ];

    public function exportAllToExcel()
    {
        if(Auth::user()->cannot('export/import')) return ;
        return Excel::download(new RequisitionsExport,'users.xlsx');
    }

    /**
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function downloadDocument(Requisition $requisition)
    {
        if(Auth::user()->cannot('export/import')) abort(403);

        if(!$requisition) abort(404);

        $replacement = $this->formatRequisition($requisition);

        $templateProcessor = new TemplateProcessor(public_path('templates/req_template.docx'));

        $templateProcessor->setValues($replacement);
        $file_path = storage_path('outputs/' .
            $requisition->person->user_id .
            '/req_output' .
            str_replace(' ', '_', $requisition->person->full_name) .
            '.docx');

        $templateProcessor->saveAs($file_path);

        $requisition->is_printed = true;
        $requisition->number = $replacement['id'];
        $requisition->save();

        return response()->download($file_path);
    }

    public function downloadManyDocuments(array $requisitions = [])
    {
        if (!$requisitions or count($requisitions) <= 0) abort(404);

        $replacements = [];

        foreach ($requisitions as $requisition) {
            $replacements[] = $this->formatRequisition($requisition);
        }


    }

    public function formatRequisition(Requisition $requisition) : array
    {
        $number = Requisition::whereNotNull('number')->max('number')?->number ?? 0;
        return [
            "id" => $requisition->number ?? ++$number,
            "requisition_date" => Carbon::now()->format('Y-m-d'),
            "full_name" => $requisition->person->first_name. ' ' . $requisition->person->last_name,
            "type" => Requisition::$types[$requisition->type],
            "rank" => Person::$ranks[$requisition->person->rank],
            "category" => Person::$classes[$requisition->person->rank],
            "user_id" => $requisition->person->user_id,
        ];
    }

    /**
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function downloadDocuments(array $requisitionsIds = null)
    {
        if(Auth::user()->cannot('export/import')) abort(403);

        $templateProcessor = new TemplateProcessor(public_path('templates/req_template.docx'));
        $replacements = [];
        $number = Requisition::query()->max('number')??1;

        $requisitionsIds = $requisitionsIds??Requisition::whereNull('printed_by')->pluck('id');
        $requisitions = Requisition::whereIn('id',$requisitionsIds)->get();

        foreach ($requisitions as $requisition) {
            if (!$requisition->person) continue ;
            $replacements[] = [
                "id" => $requisition->number ?? $number++,
//                "requisition_date" => Carbon::now()->format('Y-m-d'),
                "requisition_date" => $requisition->requisition_date,
                "full_name" => $requisition->person->first_name. ' ' . $requisition->person->last_name,
                "type" => Requisition::$types[$requisition->type],
                "rank" => Person::$ranks[$requisition->person->rank],
                "category" => Person::$classes[$requisition->person->rank],
//                "user_id" => $requisition->person->user_id,
            ];
        }

        if (sizeof($replacements)==0) abort(404);
        $templateProcessor->cloneBlock('requisition_block', 0, true, false, $replacements);
        $templateProcessor->saveAs(public_path('templates/req_output.docx'));

        Requisition::whereIn('id',$requisitionsIds)->update(['printed_by'=>Auth::id()]);
        return response()->download(public_path('templates/req_output.docx'));
    }

    public function render()
    {
        return view('requisition.index');
    }
}
