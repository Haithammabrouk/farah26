<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalTripTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'additional_trip_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
        'details'
    ];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
