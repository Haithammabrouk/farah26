<?php

namespace App\Repositories\AdminPanel;

use App\Models\Itinerary;
use App\Repositories\BaseRepository;

/**
 * Class ItineraryRepository
 * @package App\Repositories\AdminPanel
 * @version August 24, 2020, 7:15 pm UTC
*/

class ItineraryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'trip_category_id',
        'day'
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
        return Itinerary::class;
    }
}
