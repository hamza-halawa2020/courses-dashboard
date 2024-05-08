<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Notifiable, LaratrustUserTrait;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'image',
        'phone',
        'stage_id',
        'gender',
        'parent_name',
        'parent_phone',
        'status',
        'device_id',
        'place_id'
    ];

    protected $appends = ['image_path'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //atr
    public function getNameAttribute($value)
    {
        return ucfirst($value);

    }// end of getNameAttribute

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return Storage::url('uploads/' . $this->image);
        }

        return asset('admin_assets/images/default.png');

    }// end of getImagePathAttribute

    //scope
    public function scopeWhenRoleId($query, $roleId)
    {
        return $query->when($roleId, function ($q) use ($roleId) {

            return $q->whereHas('roles', function ($qu) use ($roleId) {

                return $qu->where('id', $roleId);

            });

        });

    }// end of scopeWhenRoleId

    public function scopeWhenType($query, $type)
    {
        return $query->when($type, function ($q) use ($type) {

            return $q->where('type', $type);
        });

    }// end of scopeWhenType

    //rel
    public function favouriteCoupons()
    {

        return $this->belongsToMany(Coupon::class, 'user_favourite_coupon', 'user_id', 'coupon_id');

    }
    public function balances()
    {
        return $this->hasMany(Balance::class);
    }
    public function adminAddedBalances()
    {
        return $this->hasMany(AdminAddedBalance::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    //fun
    public function hasImage()
    {
        return $this->image != null;

    }// end of hasImage


}//end of model
