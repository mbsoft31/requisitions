<?php

namespace App\Imports;

use App\Contracts\Person\CreatePerson;
use App\Contracts\Requisition\CreateRequisition;
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
        dd($row);
        $data = [
            'first_name' => $row['alasm'],
            'last_name' => $row['allkb'],
            'birthdate' => date("y-m-d", strtotime($row['tarykh_almylad'])),
            'location_of_birth' => $row['mkan_almylad'],
            'rank' => $row['alsnf'],
            'commission' => $row['alhyy_almstkhdm'],
            'original_job' => $row['alothyf_alasly'],
            'requisition_date' => date("y-m-d", strtotime($row['tarykh_altskhyr'])),
        ];
        return new Requisition([]);
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
