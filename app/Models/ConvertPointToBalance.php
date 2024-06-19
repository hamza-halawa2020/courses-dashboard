<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvertPointToBalance extends Model
{
    use HasFactory;
    protected $fillable = ['balance_detail_id', 'point_detail_id', 'amount'];

    public function balanceDetails()
    {
        return $this->belongsTo(BalanceDetail::class);
    }
    public function pointDetails()
    {
        return $this->belongsTo(PointDetail::class);
    }
}
