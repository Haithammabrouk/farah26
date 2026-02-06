<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ClosedDates
 * @package App\Models
 * @version December 21, 2020, 3:00 pm UTC
 *
 * @property string $date
 */
class ClosedDates extends Model
{

    public $table = 'closed_dates';
    

    public $fillable = [
        'date'
    ];

    public $timestamps = false;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required|date'
    ];
}
