<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'facility_translations';

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
        'details'
    ];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
