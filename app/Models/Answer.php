<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['answer', 'question_id', 'is_right'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function testingQuestion()
    {
        return $this->hasMany(TestingQuestion::class);
    }

}
