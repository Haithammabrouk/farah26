<?php

namespace App\Repositories\AdminPanel;

use App\Models\TripCategory;
use App\Repositories\BaseRepository;

/**
 * Class TripCategoryRepository
 * @package App\Repositories\AdminPanel
 * @version July 28, 2020, 1:21 pm UTC
*/

class TripCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'duration',
        'desc',
        'rate_plan'
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
        return TripCategory::class;
    }
}
