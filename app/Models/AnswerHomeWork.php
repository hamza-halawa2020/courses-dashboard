<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerHomeWork extends Model
{
    use HasFactory;
    protected $fillable = ['answer', 'question_home_work_id', 'is_right'];

    public function questionHomeWork()
    {
        return $this->belongsTo(QuestionHomeWork::class);
    }
    public function testingQuestionHomeWork()
    {
        return $this->hasMany(TestingQuestionHomeWork::class);
    }
}
