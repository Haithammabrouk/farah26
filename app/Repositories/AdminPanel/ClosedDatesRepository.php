<?php

namespace App\Repositories\AdminPanel;

use App\Models\ClosedDates;
use App\Repositories\BaseRepository;

/**
 * Class ClosedDatesRepository
 * @package App\Repositories\AdminPanel
 * @version December 21, 2020, 3:00 pm UTC
*/

class ClosedDatesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date'
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
        return ClosedDates::class;
    }
}
