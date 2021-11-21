<?php

namespace App\View\Requisition;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;
    protected $listeners = [
        'openUploadForm'=>'openUploadForm',
    ];
//    use WithFileUploads;
    public $show = false;
    public $file = null;

    public function openUploadForm()
    {
        $this->show = true;
    }
    public function closeUploadForm()
    {
        $this->show = false;
    }

    public function check()
    {
        dd($this->file);
    }
    public function save()
    {

    }

    public function render()
    {
//        $this->file = null ;
        return view('requisition.upload-file');
    }
}
