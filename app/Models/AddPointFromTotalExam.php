<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPointFromTotalExam extends Model
{
    use HasFactory;
    protected $fillable = ['point_detail_id', 'testing_total_exam_id'];

    public function testingTotalExam()
    {
        return $this->belongsTo(TestingTotalExam::class);
    }

    public function pointDetails()
    {
        return $this->belongsTo(PointDetail::class);
    }
}
