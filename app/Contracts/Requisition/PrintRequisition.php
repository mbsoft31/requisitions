<?php

namespace App\Contracts\Requisition;

use App\Models\Requisition;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface PrintRequisition
{
    public function file_path( Requisition $requisition);

    public function check_dir($requisition_type = "preparation");

    public function formatRequisition(Requisition $requisition) : array;

    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function downloadDocument(Requisition $requisition): BinaryFileResponse;

    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function downloadManyDocuments($requisitions): BinaryFileResponse;
}
