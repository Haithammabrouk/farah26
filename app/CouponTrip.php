<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponTrip extends Model
{
    public $fillable = ["coupon_id" , "trip_id"];
}
