<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerTotalExam extends Model
{
    use HasFactory;
    protected $fillable = ['answer', 'total_exam_id', 'is_right'];

    public function totalExam()
    {
        return $this->belongsTo(TotalExam::class);
    }
    public function testingTotalExam()
    {
        return $this->hasMany(TestingTotalExam::class);
    }
}
