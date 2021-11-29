<?php

namespace App\View\Requisition;

use App\Contracts\Requisition\PrintRequisition;
use App\Models\Person;
use App\Models\Requisition;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class PrintFile extends Component
{
    protected $listeners = [
        'openPrintForm'=>'openPrintForm',
    ];

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
        $requisitionsIds = ($this->commission === 'all') ? null : $reqs->pluck('id')->toArray();

        return $this->downloadManyDocuments($requisitionsIds);
    }

    public function downloadManyDocuments($requisitions)
    {
        /** @var PrintRequisition $printer */
        $printer = App::make(PrintRequisition::class);

        $reqs = Requisition::find($requisitions);

        return $printer->downloadManyDocuments($reqs);
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
