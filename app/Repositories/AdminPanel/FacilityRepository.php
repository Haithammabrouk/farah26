<?php

namespace App\Repositories\AdminPanel;

use App\Models\Facility;
use App\Repositories\BaseRepository;

/**
 * Class FacilityRepository
 * @package App\Repositories\AdminPanel
 * @version August 24, 2020, 5:45 pm UTC
*/

class FacilityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Facility::class;
    }
}
