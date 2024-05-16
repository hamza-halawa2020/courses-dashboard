<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'title', 'stage_id', 'teacher_id'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function teachers()
    {
        return $this->belongsTo(Teacher::class);
    }
}
