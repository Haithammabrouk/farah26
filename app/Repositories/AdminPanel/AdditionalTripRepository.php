<?php

namespace App\Repositories\AdminPanel;

use App\Models\AdditionalTrip;
use App\Repositories\BaseRepository;

/**
 * Class AdditionalTripRepository
 * @package App\Repositories\AdminPanel
 * @version August 19, 2020, 1:05 pm UTC
*/

class AdditionalTripRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'trip_category_id',
        'SinglePrice',
        'price',
        'img'
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
        return AdditionalTrip::class;
    }
}
