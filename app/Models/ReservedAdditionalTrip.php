<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ReservedAdditionalTrip
 * @package App\Models
 * @version August 25, 2020, 5:53 pm UTC
 *
 * @property \App\Models\Reservation $reservation
 * @property \App\Models\AdditionalTrip $additionalTrip
 * @property integer $reservation_id
 * @property integer $additional_trip_id
 * @property number $price
 * @property number $SinglePrice
 * @property integer $adults_count
 * @property integer $child1_count
 * @property integer $child2_count
 * @property number $total_price
 */
class ReservedAdditionalTrip extends Model
{

    public $table = 'reserved_additional_trips';




    public $fillable = [
        'reservation_id',
        'additional_trip_id',
        'price',
        'SinglePrice',
        'adults_count',
        'child1_count',
        'child2_count',
        'total_price',
        'status',

    ];


    public function reservation()
    {
        return $this->belongsTo(\App\Models\Reservation::class);
    }


    public function additionalTrip()
    {
        return $this->belongsTo(\App\Models\AdditionalTrip::class);
    }
}
