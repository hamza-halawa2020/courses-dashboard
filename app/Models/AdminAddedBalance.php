<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAddedBalance extends Model
{
    use HasFactory;
    protected $fillable = ['balance_details_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balanceDetails()
    {
        return $this->hasMany(BalanceDetail::class);
    }
}
