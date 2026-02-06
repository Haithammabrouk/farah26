<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $fillable = ["coupon_code" , "code_duration" , "discount" , "usage_limit" , "active" ];

    public function related_trips()
    {
        return $this->hasMany(CouponTrip::class);
    }

    public function coupon_users()
    {
        return $this->hasMany(CouponUsers::class);
    }


}
