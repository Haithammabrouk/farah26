<?php

namespace App\Repositories\AdminPanel;

use App\Models\FacilityPhoto;
use App\Repositories\BaseRepository;

/**
 * Class FacilityPhotoRepository
 * @package App\Repositories\AdminPanel
 * @version September 1, 2020, 1:14 pm UTC
*/

class FacilityPhotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'photo'
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
        return FacilityPhoto::class;
    }
}
