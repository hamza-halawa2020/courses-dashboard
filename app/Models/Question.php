<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'stage_id'];
    protected $table = 'questions';

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
