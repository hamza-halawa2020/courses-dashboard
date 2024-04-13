<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'tittle','stage_id'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
}
