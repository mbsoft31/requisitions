<?php

namespace App\Exports;

use App\Models\Requisistions;
use App\Models\Requisition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RequisitionsExport implements
    FromCollection,
    WithHeadingRow,
    WithHeadings,
    WithCustomStartCell,
    WithMapping,
    ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Requisition::all();
    }
    public function headings(): array
    {
        return [
            'رقم التسخيرة',
            'تاريخ التسخيرة',
            'الإسم',
            'اللقب',
            'تاريخ الميلاد',
            'مكان الميلاد',
            'الوظيفة الأصلية',
            'الرتبة',
            'الهيئة المستخدمة',
            'الصنف',
            'نوع التسخيرة',
            'الجهة المسخر فيها',
            'المهام الموكلة اليه',
        ];
    }
    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }

    public function map($row): array
    {
        dd($row);
        $data = [
            $row->id,
            $row->personn->requisition_date,
            $row->personn->first_name,
            $row->personn->last_name,
            $row->personn->date_of_birth,
            $row->personn->location_of_birth,
            $row->personn->original_job,
            $row->personn->rank,
            $row->personn->commission,
            $row->personn->get_category(),
            $row->get_type(),
            $row->requisition_destination,
            $row->authorized_tasks,
        ];
        return $data;
    }

    public function startCell(): string
    {
        return "A1";
    }
}
