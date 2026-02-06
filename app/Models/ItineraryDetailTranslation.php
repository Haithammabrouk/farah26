<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItineraryDetailTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'itinerary_detail_translations';

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
        'text',
    ];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
