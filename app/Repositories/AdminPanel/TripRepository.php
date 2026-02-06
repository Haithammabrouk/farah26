<?php

namespace App\Repositories\AdminPanel;

use App\Models\Trip;
use App\Repositories\BaseRepository;

/**
 * Class TripRepository
 * @package App\Repositories\AdminPanel
 * @version July 28, 2020, 1:32 pm UTC
*/

class TripRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'trip_category_id',
        'check_in',
        'check_out',
        'cabin_count',
        'suite_count',
        'cabin_price',
        'suite_price',
        'cabin_available',
        'suite_available'
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
        return Trip::class;
    }
}
