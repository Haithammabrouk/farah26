<?php

namespace App\Repositories\AdminPanel;

use App\Models\Contactus;
use App\Repositories\BaseRepository;

/**
 * Class ContactusRepository
 * @package App\Repositories\AdminPanel
 * @version August 24, 2020, 3:17 pm UTC
*/

class ContactusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'mobile',
        'message'
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
        return Contactus::class;
    }
}
