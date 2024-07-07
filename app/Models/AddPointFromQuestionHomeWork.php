<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPointFromQuestionHomeWork extends Model
{
    use HasFactory;
    protected $fillable = ['point_detail_id', 'testing_q_h_w_id'];

    public function testingQuestionHomeWork()
    {
        return $this->belongsTo(TestingQuestionHomeWork::class);
    }

    public function pointDetails()
    {
        return $this->belongsTo(PointDetail::class);
    }
}
