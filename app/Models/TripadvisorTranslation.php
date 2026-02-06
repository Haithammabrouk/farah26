<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripadvisorTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'tripadvisor_translations';

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
        'title',
        'text',
    ];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
