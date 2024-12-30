<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuestionsExport implements FromCollection, WithHeadings
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

        foreach ($this->teacher->question as $question) {
            foreach ($question->answers as $answers) {
                foreach ($answers->testingQuestion as $testingQuestion) {
                    $purchaseDate = Carbon::parse($testingQuestion->created_at);

                    if (
                        (!$this->startDate || $purchaseDate->gte($this->startDate)) &&
                        (!$this->endDate || $purchaseDate->lte($this->endDate))
                    ) {
                        $data[] = [
                            '#' => $i++,
                            'student Name' => $testingQuestion->user->name ?? '-',
                            'student Phone' => $testingQuestion->user->phone ?? '-',
                            'question' => $question->question ?? '-',
                            'answer' => $testingQuestion->answer->answer ?? '-',
                            'Purchase Date' => $testingQuestion->created_at ?? '-',
                        ];

                    }
                }
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'عدد الاسئلة',
            'اسم الطالب',
            'رقم الهاتف',
            'السؤال',
            'الاجابة',
            'تاريخ الاجابه',
        ];
    }
}
