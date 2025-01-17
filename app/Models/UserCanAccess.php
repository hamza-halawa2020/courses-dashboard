<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCanAccess extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'lecture_id',
        'chapter_id',
        'watched',
    ];

    protected $table = 'user_can_access';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function buyCourseBalance()
    {
        return $this->hasMany(BuyCourseBalance::class);
    }
}
