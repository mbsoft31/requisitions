<?php

namespace App\Exports;

use App\Models\Person;
use App\Models\Requisition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class RequisitionsExport implements
    FromCollection,
    WithHeadingRow,
    WithHeadings,
    WithCustomStartCell,
    WithMapping,
    ShouldAutoSize,
    WithEvents
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
            'اللقب',
            'الإسم',
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
//        dd($row->person);
        if (!$row->person) return [];
        $data = [
            $row->id,
            $row->person->requisition_date,
            $row->person->first_name,
            $row->person->last_name,
            $row->person->birthdate,
            $row->person->location_of_birth,
            $row->person->birth_place,
            Person::$ranks[$row->person->rank],
            $row->person->commission,
            Person::$classes[$row->person->rank],
            Requisition::$types[$row->type],
            $row->destination,
            $row->authorized_tasks,
        ];
        return $data;
    }

    public function startCell(): string
    {
        return "A1";
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }
}
