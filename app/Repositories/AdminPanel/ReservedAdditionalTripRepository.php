<?php

namespace App\Repositories\AdminPanel;

use App\Models\ReservedAdditionalTrip;
use App\Repositories\BaseRepository;

/**
 * Class ReservedAdditionalTripRepository
 * @package App\Repositories\AdminPanel
 * @version August 25, 2020, 5:53 pm UTC
*/

class ReservedAdditionalTripRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reservation_id',
        'additional_trip_id',
        'price',
        'adults_count',
        'child1_count',
        'child2_count',
        'total_price'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ReservedAdditionalTrip::class;
    }
}
