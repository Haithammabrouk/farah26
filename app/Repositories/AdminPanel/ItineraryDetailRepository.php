<?php

namespace App\Repositories\AdminPanel;

use App\Models\ItineraryDetail;
use App\Repositories\BaseRepository;

/**
 * Class ItineraryDetailRepository
 * @package App\Repositories\AdminPanel
 * @version August 24, 2020, 7:33 pm UTC
*/

class ItineraryDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'itinerary_id'
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
        return ItineraryDetail::class;
    }
}
