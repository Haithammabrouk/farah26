<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeckTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'deck_translations';

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
        'content'
    ];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
