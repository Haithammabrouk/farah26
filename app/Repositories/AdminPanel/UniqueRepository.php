<?php

namespace App\Repositories\AdminPanel;

use App\Models\Unique;
use App\Repositories\BaseRepository;

/**
 * Class UniqueRepository
 * @package App\Repositories\AdminPanel
 * @version September 8, 2020, 8:11 am UTC
*/

class UniqueRepository extends BaseRepository
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
        return Unique::class;
    }
}
