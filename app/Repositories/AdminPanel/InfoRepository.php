<?php

namespace App\Repositories\AdminPanel;

use App\Models\Info;
use App\Repositories\BaseRepository;

/**
 * Class InfoRepository
 * @package App\Repositories\AdminPanel
 * @version August 24, 2020, 6:28 pm UTC
*/

class InfoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'value',
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
        return Info::class;
    }
}
