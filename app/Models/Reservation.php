<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reservation
 * @package App\Models
 * @version July 28, 2020, 6:14 pm UTC
 *
 * @property \App\Models\Trip $trip
 * @property \App\Models\User $user
 * @property integer $trip_id
 * @property integer $user_id
 * @property number $price
 * @property string $comment
 * @property integer $status
 */
class Reservation extends Model
{
    // use SoftDeletes;

    public $table = 'reservations';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'trip_id',
        'user_id',
        'price',
        'comment',
        'ip_address',
        'uuid',
        'status',
        'payment_res_code',
        'payment_res_msg',
        'payment_res_full'
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function trip()
    {
        return $this->belongsTo(\App\Models\Trip::class)->withTrashed();
    }


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accommodations()
    {
        return $this->hasMany(\App\Models\Accommodation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reservedAdditionalTrips()
    {
        return $this->hasMany(\App\Models\ReservedAdditionalTrip::class);
    }
}
