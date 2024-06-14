<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCourseBalance extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'balance_detail_id',
            'user_can_access_id',
            'user_id'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balanceDetails()
    {
        return $this->belongsTo(BalanceDetail::class);
    }

    public function userCanAccess()
    {
        return $this->belongsTo(UserCanAccess::class);
    }

}
