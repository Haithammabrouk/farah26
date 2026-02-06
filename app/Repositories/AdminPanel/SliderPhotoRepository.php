<?php

namespace App\Repositories\AdminPanel;

use App\Models\SliderPhoto;
use App\Repositories\BaseRepository;

/**
 * Class SliderPhotoRepository
 * @package App\Repositories\AdminPanel
 * @version September 10, 2020, 4:08 pm UTC
*/

class SliderPhotoRepository extends BaseRepository
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
        return SliderPhoto::class;
    }
}
