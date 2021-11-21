<?php

namespace App\Imports;

use App\Contracts\Person\CreatePerson;
use App\Contracts\Requisition\CreateRequisition;
use App\Models\Person;
use App\Models\Requisition;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RequisitionsImport implements ToModel,WithHeadingRow,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $personCreator = app()->make(CreatePerson::class);
        $requisitionCreator = app()->make(CreateRequisition::class);
        $data = [
            'first_name' => $row['alasm'],
            'last_name' => $row['allkb'],
            'birthdate' => $row['tarykh_almylad'],
            'birth_place' => $row['mkan_almylad'],
//            'rank' => $row['alsnf'],
            'rank' => array_search($row['alsnf'],Person::$ranks),
            'commission' => $row['alhyy_almstkhdm'],
            'original_job' => $row['alothyf_alasly'],
            'requisition_date' => $row['tarykh_altskhyr'],
        ];
        $requistionInputs=[
            'destination' => $row['algh_almskhr_fyha'],
            'authorized_tasks' => $row['almham_almokl_alyh'],
        ];
        $person = $personCreator->create($data);
        $type = null ;
        foreach (Requisition::$types as $key =>$value)
            if (str_contains($row['alsnf'],$value)) $type = $key;
        if ($type) {
            $requisitionCreator->create($requistionInputs,$type,$person);
        }
        return $person;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }
}
