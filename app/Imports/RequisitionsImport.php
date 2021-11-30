<?php

namespace App\Imports;

use App\Contracts\Person\CreatePerson;
use App\Contracts\Requisition\CreateRequisition;
use App\Models\Person;
use App\Models\Requisition;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RequisitionsImport implements ToModel,WithHeadingRow,WithStartRow
{

    public static $count = 0 ;

    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {

        $personCreator = app()->make(CreatePerson::class);
        $requisitionCreator = app()->make(CreateRequisition::class);

        $data = [
            'first_name'       => $row['alasm'],
            'last_name'        => $row['allkb'],
            'birthdate'        => $row['tarykh_almylad'],
            'birth_place'      => $row['mkan_almylad'],
            'rank'             => $row['alrtb'],
            'commission'       => $row['alhyy_almstkhdm'],
            'original_job'     => $row['alothyf_alasly'],
            'requisition_date' => $row['tarykh_altskhyr'],
        ];

        $requistionInputs=[
            'destination'      => $row['algh_almskhr_fyha'],
            'authorized_tasks' => $row['almham_almokl_alyh'],
            'expeditor'        => $row["algh_almrsl"],
            'invoice_number'   => $row["rkm_alarsaly"],
            'invoice_date'     => $row["tarykh_alarsaly"],
        ];

        $person = $personCreator->create($data);
        $type = -1 ;

        foreach (Requisition::$types as $key =>$value)
        {
            if (str_contains($row['noaa_altskhyr'], $value))
            {
                $type = $key;
            }
        }

        if ($type!=-1) {
            $requisitionCreator->create($requistionInputs,$type,$person);
            self::$count++;
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
