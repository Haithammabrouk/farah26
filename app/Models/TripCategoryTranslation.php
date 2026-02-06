<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripCategoryTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'trip_category_translations';

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
        'duration',
        'rate_plan',
        'desc',
    ];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
