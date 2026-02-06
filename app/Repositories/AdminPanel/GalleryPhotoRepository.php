<?php

namespace App\Repositories\AdminPanel;

use App\Models\GalleryPhoto;
use App\Repositories\BaseRepository;

/**
 * Class GalleryPhotoRepository
 * @package App\Repositories\AdminPanel
 * @version August 23, 2020, 7:32 pm UTC
*/

class GalleryPhotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'gallery_id',
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
        return GalleryPhoto::class;
    }
}
