<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'details'];


    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function totalExam()
    {
        return $this->hasMany(TotalExam::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }
}

