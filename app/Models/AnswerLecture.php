<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerLecture extends Model
{
    use HasFactory;
    protected $fillable = ['answer', 'exam_lecture_id', 'is_right'];

    public function examLecture()
    {
        return $this->belongsTo(ExamLecture::class);
    }

    public function testingExamLecture()
    {
        return $this->hasMany(TestingExamLecture::class);
    }
}
