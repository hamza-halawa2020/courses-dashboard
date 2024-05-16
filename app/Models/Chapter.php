<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'title', 'course_id', 'price'];


    //scope

    public function scopeWhenCourseId($query, $courseId)
    {
        return $query->when($courseId, function ($q) use ($courseId) {

            return $q->whereHas('course', function ($qu) use ($courseId) {

                return $qu->where('courses.id', $courseId);
            });

        });

    }

    // relations
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

}
