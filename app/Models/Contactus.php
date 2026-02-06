<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Contactus
 * @package App\Models
 * @version August 24, 2020, 3:17 pm UTC
 *
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $message
 */
class Contactus extends Model
{

    public $table = 'contactuses';
    



    public $fillable = [
        'name',
        'email',
        'mobile',
        'message'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        'message' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
