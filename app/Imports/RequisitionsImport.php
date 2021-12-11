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
    public static array $oldPeople;

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
            'birthdate'        => "1980-01-01",
            'birth_place'      => "/",
            'rank'             => $row['alrtb'],
            'commission'       => $row['alhyy_almstkhdm'],
            'original_job'     => $row['alothyf_alasly'],
            'requisition_date' => "2021-11-20",
        ];

        $requistionInputs=[
            'destination'      => $row['algh_almskhr_fyha'],
            'authorized_tasks' => $row['almham_almokl_alyh'],
            'expeditor'        => $row["algh_almrsl"],
            'invoice_number'   => $row["rkm_alarsaly"],
            'invoice_date'     => "2021-01-01",
        ];
        // if the person exists in the database .
        $person = Person::where('first_name',$data['first_name'])
            ->where('last_name',$data['last_name'])->first();
        if ($person) {
            self::$oldPeople[] = $person;
        }

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
