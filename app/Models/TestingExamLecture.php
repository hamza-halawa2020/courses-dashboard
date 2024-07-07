<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestingExamLecture extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'answer_lecture_id', 'is_right'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function answerLecture()
    {
        return $this->belongsTo(AnswerLecture::class);
    }
    public function addPointFromExamLecture()
    {
        return $this->hasMany(AddPointFromExamLecture::class);
    }

}
