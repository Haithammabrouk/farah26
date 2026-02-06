<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Info
 * @package App\Models
 * @version August 24, 2020, 6:28 pm UTC
 *
 * @property string $key
 * @property string $value
 */
class Info extends Model
{

    public $table = 'infos';
    



    public $fillable = [
        'key',
        'value',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'key' => 'string',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'key' => 'required',
        'value' => 'required'
    ];

    
}
