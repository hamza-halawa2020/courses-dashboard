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
    public function qrAddedBalances()
    {
        return $this->hasMany(QrAddedBalance::class);
    }
    public function adminAddedBalances()
    {
        return $this->hasMany(AdminAddedBalance::class);
    }

    public function buyCourseBalance()
    {
        return $this->hasMany(BuyCourseBalance::class);
    }
}
