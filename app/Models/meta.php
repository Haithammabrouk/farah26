<?php

namespace App\Models;

use Eloquent as Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class meta
 * @package App\Models
 * @version September 23, 2020, 4:00 pm UTC
 *
 * @property string $name
 */
class meta extends Model implements TranslatableContract
{
    use Translatable;

    public $table = 'metas';

    public $fillable = [
        'name'
    ];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  ['title', 'description', 'keywords'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}
