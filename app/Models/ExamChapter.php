<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamChapter extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function answerChapter()
    {
        return $this->hasMany(AnswerChapter::class);
    }
}
