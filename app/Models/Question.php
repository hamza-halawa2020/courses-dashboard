<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'stage_id', 'teacher_id'];
    protected $table = 'questions';

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
