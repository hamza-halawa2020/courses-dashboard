<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalExam extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function answerTotalExam()
    {
        return $this->hasMany(AnswerTotalExam::class);
    }
}
