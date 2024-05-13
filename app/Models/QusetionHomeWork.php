<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QusetionHomeWork extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'lecture_id'];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
    public function answerHomeWork()
    {
        return $this->hasMany(AnswerHomeWork::class);
    }


}
