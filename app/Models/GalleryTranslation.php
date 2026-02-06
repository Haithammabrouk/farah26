<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryTranslation extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'gallery_translations';

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
    protected $fillable = ['name'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
