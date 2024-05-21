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
    ];

    protected $table = 'user_can_access';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lecture()
    {
        return $this->belongsTo(lecture::class);
    }
}
