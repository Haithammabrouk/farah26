<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniqueTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'unique_translations';

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
    protected $fillable = ['title', 'text'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
