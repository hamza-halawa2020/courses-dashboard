<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name'];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function notifiactions()
    {
        return $this->hasMany(Notification::class);
    }
}
