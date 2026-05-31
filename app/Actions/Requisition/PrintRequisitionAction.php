<?php

namespace App\Actions\Requisition;

use App\Contracts\Requisition\PrintRequisition;
use App\Models\Person;
use App\Models\Requisition;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PrintRequisitionAction implements PrintRequisition
{
    public function file_path( Requisition $requisition)
    {
        $requisition_type = ( Requisition::$PREPARATION == $requisition->type ) ? 'preparation' : 'management';

        $dir = $this->check_dir($requisition_type);

        $person = str_replace(' ', '_', $requisition->person->full_name);

        return public_path($dir . '/req_output_' . $person . '.docx' );
    }

    public function check_dir($requisition_type = "preparation")
    {
        $user_id = Auth::id();

        if ( ! File::isDirectory( public_path('outputs/' . $user_id) ) )
            $user_dir = File::makeDirectory(public_path('outputs/' . $user_id));

        if ( ! File::isDirectory( public_path('outputs/' . $user_id . "/" . $requisition_type ) ))
            $user_type_dir = File::makeDirectory( public_path('outputs/' . $user_id . "/" . $requisition_type . "/" ) );

        return 'outputs/' . $user_id . "/" . $requisition_type ;
    }

    public function formatRequisition(Requisition $requisition) : array
    {
        $number = Requisition::whereNotNull('number')->get()->max('number');
        return [
            "id" => sprintf("%04d", $requisition->number ?? ++$number),
            "requisition_date" => "20-11-2021",
            "full_name" => $requisition->person->first_name. ' ' . $requisition->person->last_name,
            "type" => Requisition::$types[$requisition->type],
            "rank" => Person::$ranks[$requisition->person->rank], // $requisition->authorized_tasks . " " . $requisition->person->original_job, //.
            "category" => Person::$classes[$requisition->person->rank],
            "user_id" => $requisition->person->user_id,
        ];
    }

    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function downloadDocument(Requisition $requisition): BinaryFileResponse
    {
        if( Auth::user()->cannot('export/import') ) abort(403);

        if( is_null($requisition) ) abort(404);

        // dd($requisition);

        $replacement = $this->formatRequisition($requisition);

        $templateProcessor = new TemplateProcessor(public_path('templates/req_template.docx'));

        $templateProcessor->cloneBlock(
            'requisition_block',
            0,
            true,
            false,
            [$replacement]
        );
        // $templateProcessor->setValues($replacement);

        $file_path = $this->file_path($requisition);

        $templateProcessor->saveAs( $file_path );

        $requisition->update( [
            "printed_by" => true,
            "number" => $replacement['id'],
        ] );

        return response()->download($file_path);
    }

    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function downloadManyDocuments($requisitions): BinaryFileResponse
    {
        if (!$requisitions or count($requisitions) <= 0) abort(404);

        $replacements = [];

        foreach ($requisitions as $requisition)
            $replacements[] = $this->formatRequisition($requisition);

        $templateProcessor = new TemplateProcessor(public_path('templates/req_template.docx'));

        $templateProcessor->cloneBlock(
            'requisition_block',
            0,
            true,
            false,
            $replacements
        );

        $templateProcessor->saveAs(public_path('templates/req_output.docx'));

        $number = Requisition::whereNotNull('number')->get()->max('number');

        foreach ($requisitions as $requisition)
        {
            if (! $requisition->number)
                $requisition->update( [
                    'printed_by' => Auth::id(),
                    'number' => ++$number,
                ] );
        }

        return response()->download(public_path('templates/req_output.docx'));
    }

}
