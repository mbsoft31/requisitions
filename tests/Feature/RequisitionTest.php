<?php

namespace Tests\Feature;

use App\Contracts\Person\CreatePerson;
use App\Contracts\Requisition\CreateRequisition;
use App\Models\Person;
use App\Models\Requisition;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PhpOffice\PhpWord\TemplateProcessor;
use Tests\TestCase;

class RequisitionTest extends TestCase
{
    /**
     * A basic test_can_create_person.
     *
     * @return void
     * @throws
     */
    public function test_can_create_person()
    {
        $templateProcessor = new TemplateProcessor(public_path('templates/req_template.docx'));

        $replacements = [
            [
                "id" => 1,
                "requisition_date" => Carbon::now()->format('Y-m-d'),
                "full_name" => "بخوش معاذ",
                "type" => "تسيير",
                "rank" => 14,
                "category" => 5,
            ],
            [
                "id" => 2,
                "requisition_date" => Carbon::now()->format('Y-m-d'),
                "full_name" => "عياري محمد الهادي",
                "type" => "تحضير",
                "rank" => 14,
                "category" => 6,
            ],
            [
                "id" => 3,
                "requisition_date" => Carbon::now()->format('Y-m-d'),
                "full_name" => "برينيس عبد الرحمان",
                "type" => "تسيير",
                "rank" => 14,
                "category" => 4,
            ],
        ];

        dump($templateProcessor->getVariables());

        $templateProcessor->cloneBlock('requisition_block', 0, true, false, $replacements);

        $templateProcessor->saveAs(public_path('templates/req_output.docx'));

    }


}
