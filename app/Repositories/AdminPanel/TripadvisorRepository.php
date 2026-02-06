<?php

namespace App\Repositories\AdminPanel;

use App\Models\Tripadvisor;
use App\Repositories\BaseRepository;

/**
 * Class TripadvisorRepository
 * @package App\Repositories\AdminPanel
 * @version September 9, 2020, 3:13 pm UTC
*/

class TripadvisorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'author'
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
        return Tripadvisor::class;
    }
}
