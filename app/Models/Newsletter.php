<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Newsletter
 * @package App\Models
 * @version August 25, 2020, 3:48 pm UTC
 *
 * @property string $email
 */
class Newsletter extends Model
{

    public $table = 'newsletters';
    



    public $fillable = [
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
