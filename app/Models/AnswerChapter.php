<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerChapter extends Model
{
    use HasFactory;
    protected $fillable = ['answer', 'total_exam_id', 'is_right'];

    public function examChapter()
    {
        return $this->belongsTo(ExamChapter::class);
    }
}
