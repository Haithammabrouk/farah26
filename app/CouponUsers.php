<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponUsers extends Model
{
    public $fillable = ["user_mobile" , "coupon_id"];


}
