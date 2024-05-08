<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceDetail extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'balance_id'];

    public function balance()
    {
        return $this->belongsTo(Balance::class);
    }
}
