<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    private $teacher;
    private $startDate;
    private $endDate;

    public function __construct($teacherId, $startDate, $endDate)
    {
        $this->teacher = Teacher::findOrFail($teacherId);
        $this->startDate = $startDate ? Carbon::parse($startDate) : null;
        $this->endDate = $endDate ? Carbon::parse($endDate) : null;
    }

    public function collection()
    {
        $data = [];
        $i = 1;

        foreach ($this->teacher->courses as $course) {
            foreach ($course->chapters as $chapter) {
                foreach ($chapter->lectures as $lecture) {
                    foreach ($lecture->userCanAccess as $user) {
                        $purchaseDate = Carbon::parse($user->created_at);

                        if (
                            (!$this->startDate || $purchaseDate->gte($this->startDate)) &&
                            (!$this->endDate || $purchaseDate->lte($this->endDate))
                        ) {
                            $data[] = [
                                '#' => $i++,
                                'Lecture Name' => $lecture->title ?? '-',
                                'Student Name' => $user->user->name ?? '-',
                                'Student Phone' => $user->user->phone ?? '-',
                                'Lecture Cost' => $lecture->price ?? '-',
                                'Purchase Date' => $user->created_at ?? '-',
                            ];
                        }
                    }
                }
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            '#',
            'اسم المحاضرة',
            'اسم الطالب',
            'رقم الهاتف',
            'تكلفة المحاضرة',
            'تاريخ الشراء',
        ];
    }
}
