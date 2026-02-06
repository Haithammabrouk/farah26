<?php

namespace App\Repositories\AdminPanel;

use App\Models\meta;
use App\Repositories\BaseRepository;

/**
 * Class metaRepository
 * @package App\Repositories\AdminPanel
 * @version September 23, 2020, 4:00 pm UTC
*/

class metaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return meta::class;
    }
}
