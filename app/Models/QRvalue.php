<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRvalue extends Model
{
    use HasFactory;

    public $fillable=[
        'id',
        'tittle',
        'value',
    ];
   /* public function apartments(){
        return $this->hasMany(Apartment::class);
    }*/
}
