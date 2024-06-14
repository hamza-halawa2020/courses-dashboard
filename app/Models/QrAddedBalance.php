<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrAddedBalance extends Model
{
    use HasFactory;
    protected $fillable = ['balance_detail_id', 'qr_id'];

    public function qr()
    {
        return $this->belongsTo(QR::class);
    }

    public function balanceDetails()
    {
        return $this->belongsTo(BalanceDetail::class);
    }

}
