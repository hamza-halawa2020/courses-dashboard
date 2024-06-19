<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPointFromQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['point_detail_id', 'testing_question_id'];

    public function testingQuestion()
    {
        return $this->belongsTo(TestingQuestion::class);
    }

    public function pointDetails()
    {
        return $this->belongsTo(PointDetail::class);
    }
}
