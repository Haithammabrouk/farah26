<?php

namespace App\Repositories\AdminPanel;

use App\Models\AdditionalTripsPhotos;
use App\Repositories\BaseRepository;

/**
 * Class AdditionalTripsPhotosRepository
 * @package App\Repositories\AdminPanel
 * @version September 1, 2020, 10:52 am UTC
*/

class AdditionalTripsPhotosRepository extends BaseRepository
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
        return AdditionalTripsPhotos::class;
    }
}
