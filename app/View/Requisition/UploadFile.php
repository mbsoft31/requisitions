<?php

namespace App\View\Requisition;

use App\Imports\RequisitionsImport;
use App\Models\Person;
use App\Models\Requisition;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UploadFile extends Component
{
    use WithFileUploads;
    protected $listeners = [
        'openUploadForm'=>'openUploadForm',
    ];
//    use WithFileUploads;
    public $show = false;
    public $file = null;
    public $fileCount = 0;

    public function openUploadForm()
    {
        $this->show = true;
    }
    public function closeUploadForm()
    {
        $this->show = false;
        $this->clearFile();
    }

    public function clearFile()
    {
        $this->file = null ;
    }

    public function save()
    {
        dd($this->file);
    }

    public function updatedFile()
    {
        Excel::import(new RequisitionsImport, $this->file);
        $this->fileCount = RequisitionsImport::$count;
        RequisitionsImport::$count = 0 ;
    }

    public function render()
    {
        return view('requisition.upload-file');
    }
}
