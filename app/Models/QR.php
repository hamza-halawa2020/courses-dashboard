<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QR extends Model
{
    use HasFactory;
    public $fillable = [
        'id',
        'code',
        'q_rvalue_id',
        'image'
    ];


    public function scopeWhenQrvalueId($query, $qrvalue)
    {
        return $query->when($qrvalue, function ($q) use ($qrvalue) {

            return $q->whereHas('qRvalue', function ($qu) use ($qrvalue) {

                return $qu->where('q_rvalues.id', $qrvalue);
            });

        });

    }


    protected $appends = ['image_path'];

    //att
    public function getImagePathAttribute()
    {
        return '/storage/QR/' . $this->image;

    }

    public function qRvalue()
    {
        return $this->belongsTo(QRvalue::class);
    }
    public function qrAddedBalances()
    {
        return $this->hasMany(QrAddedBalance::class);
    }
}
