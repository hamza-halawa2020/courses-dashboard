<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_id',
        'title',
        'description',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}