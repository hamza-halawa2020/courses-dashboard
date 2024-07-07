<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPointFromExamLecture extends Model
{
    use HasFactory;

    protected $fillable = ['point_detail_id', 'testing_exam_lecture_id'];

    public function testingExamLecture()
    {
        return $this->belongsTo(TestingExamLecture::class);
    }

    public function pointDetails()
    {
        return $this->belongsTo(PointDetail::class);
    }
}
