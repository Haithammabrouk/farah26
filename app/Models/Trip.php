<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trip
 * @package App\Models
 * @version July 28, 2020, 1:32 pm UTC
 *
 * @property \App\Models\TripCategory $tripCategory
 * @property integer $trip_category_id
 * @property string $check_in
 * @property string $check_out
 * @property integer $cabin_count
 * @property integer $suite_count
 * @property number $cabin_price
 * @property number $suite_price
 * @property number $single_cabin_price
 * @property number $single_suite_price
 * @property integer $cabin_available
 * @property integer $suite_available
 */
class Trip extends Model
{
    use SoftDeletes;

    public $table = 'trips';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'trip_category_id',
        'check_in',
        'check_out',
        'cabin_count',
        'suite_count',
        'cabin_price',
        'suite_price',
        'single_cabin_price',
        'single_suite_price',
        'cabin_available',
        'suite_available',
        'is_home'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trip_category_id' => 'integer',
        'cabin_count' => 'integer',
        'suite_count' => 'integer',
        'cabin_price' => 'float',
        'suite_price' => 'float',
        'single_cabin_price' => 'float',
        'single_suite_price' => 'float',
        'cabin_available' => 'integer',
        'suite_available' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'trip_category_id' => 'required',
        'check_in' => 'required|before:check_out',
        'check_out' => 'required|after:check_in',
        'cabin_count' => 'required',
        'suite_count' => 'required',
        'cabin_price' => 'required',
        'suite_price' => 'required',
        'single_cabin_price' => 'required',
        'single_suite_price' => 'required',
        'closed_cabins' => 'array',
        'additional_trips' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tripCategory()
    {
        return $this->belongsTo(\App\Models\TripCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function closedCabins()
    {
        return $this->hasMany(\App\Models\ClosedCabin::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     **/
    public function accommodations()
    {
        return $this->hasManyThrough(\App\Models\Accommodation::class, \App\Models\Reservation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function tripsAdditionals()
    {
        return $this->belongsToMany('App\Models\AdditionalTrip', 'trips_additionals', 'trip_id', 'additional_trip_id');
    }
}
