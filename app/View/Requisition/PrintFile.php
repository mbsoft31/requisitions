<?php

namespace App\View\Requisition;

use App\Models\Person;
use App\Models\Requisition;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PhpOffice\PhpWord\TemplateProcessor;

class PrintFile extends Component
{
    protected $listeners = [
        'openPrintForm'=>'openPrintForm',
    ];
//    use WithFileUploads;
    public $show = false;
    public $commissions;
    public $commission;

    public function openPrintForm($show = true)
    {
        $this->commissions = Person::select('commission')->distinct()->pluck('commission');
        $this->commission = $this->commissions->first();
        $this->show = $show;

    }
    public function closePrintForm()
    {
        $this->show = false;
    }

    public function print()
    {
        $reqs = Requisition::whereHas('person', function($q){
            $q->where('commission', $this->commission);
        })->get();
        $requisitionsIds = ($this->commission==='all')?null:$reqs->pluck('id');
        $this->emit('downloadDocument',$requisitionsIds);
        $this->closePrintForm();
    }

    public function mount()
    {
        $this->openPrintForm(false);
    }

    public function render()
    {
        return view('requisition.print-file');
    }
}
