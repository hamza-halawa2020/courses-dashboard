<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestingQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'answer_id', 'is_right'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

}
