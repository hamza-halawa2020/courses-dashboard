<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'chapter_id',
        'price',
        'video_url',
        'note_book_url',
        'des',
        'notes',
        'start',
        'end',
        'status',
    ];


    //scope

    public function scopeWhenChapterId($query, $chapterId)
    {
        return $query->when($chapterId, function ($q) use ($chapterId) {

            return $q->whereHas('chapter', function ($qu) use ($chapterId) {

                return $qu->where('chapters.id', $chapterId);
            });

        });

    }

    // relations
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function questionHomeWorks()
    {
        return $this->hasMany(QuestionHomeWork::class);
    }
    public function examLectures()
    {
        return $this->hasMany(ExamLecture::class);
    }
    public function userCanAccess()
    {
        return $this->hasMany(UserCanAccess::class);
    }

}
