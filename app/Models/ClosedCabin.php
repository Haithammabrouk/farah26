<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClosedCabin extends Model
{

    public $table = 'closed_cabins';

    public $fillable = [
        'trip_id',
        'cabin_num',
        'from' ,
        'to'
    ];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function closedCabin()
    {
        return $this->hasMany(\App\Models\ClosedCabin::class);
    }
}
