<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;
    protected $fillable = ['total', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balanceDetails()
    {
        return $this->hasMany(BalanceDetail::class);
    }
    public function adminAddedBalances()
    {
        return $this->hasMany(AdminAddedBalance::class);
    }

}
