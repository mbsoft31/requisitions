<?php

namespace App\View\Requisition;
use App\Actions\Requisition\PrintRequisitionAction;
use App\Contracts\Requisition\PrintRequisition;
use App\Exports\RequisitionsExport;
use App\Models\Person;
use App\Models\Requisition;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Index extends Component
{

    protected $listeners = [
        'exportAllToExcel'=>'exportAllToExcel',
        "downloadDocument" => "downloadDocument",
        "downloadManyDocuments" => "downloadManyDocuments"
    ];

    public function exportAllToExcel(): ?BinaryFileResponse
    {
        if( Auth::user()->cannot('export/import') ) return null;

        return Excel::download(new RequisitionsExport,'users.xlsx');
    }

    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function downloadDocument(Requisition $requisition): BinaryFileResponse
    {
        /** @var PrintRequisition $printer */
        $printer = App::make(PrintRequisition::class);

        $document = $printer->downloadDocument($requisition);

        return $document;
    }

    public function downloadManyDocuments($requisitions)
    {
        /** @var PrintRequisition $printer */
        $printer = App::make(PrintRequisition::class);

        return $printer->downloadManyDocuments($requisitions);
    }

    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
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
