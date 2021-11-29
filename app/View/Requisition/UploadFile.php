<?php

namespace App\View\Requisition;

use App\Imports\RequisitionsImport;
use App\Models\Person;
use App\Models\Requisition;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UploadFile extends Component
{

    use WithFileUploads;

    protected $listeners = [
        'openUploadForm' => 'openUploadForm',
    ];

    public bool $show = false;
    public $file = null;
    public int $fileCount = 0;

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
        $this->file = null;
    }

    public function save()
    {
        dd($this->file);
    }

    public function updatedFile()
    {
        Excel::import(new RequisitionsImport, $this->file);
        $this->fileCount = RequisitionsImport::$count;
        RequisitionsImport::$count = 0;
        $this->emit('personCreated');
    }

    public function render(): Factory|View|Application
    {
        return view('requisition.upload-file');
    }
}
