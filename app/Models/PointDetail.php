<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointDetail extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'point_id'];

    public function point()
    {
        return $this->belongsTo(Point::class);
    }
    public function addPointFromQueston()
    {
        return $this->hasMany(AddPointFromQuestion::class);
    }

}
