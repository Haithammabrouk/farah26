<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Itinerary
 * @package App\Models
 * @version August 24, 2020, 7:15 pm UTC
 *
 * @property \App\Models\TripCategory $tripCategory
 * @property integer $trip_category_id
 * @property integer $day
 */
class Itinerary extends Model
{

    public $table = 'itineraries';
    



    public $fillable = [
        'trip_category_id',
        'day'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trip_category_id' => 'integer',
        'day' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'trip_category_id' => 'required',
        'day' => 'required'
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
    public function itineraryDetails()
    {
        return $this->hasMany(\App\Models\ItineraryDetail::class);
    }
}
