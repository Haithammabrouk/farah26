<?php

namespace App\Repositories\AdminPanel;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories\AdminPanel
 * @version January 15, 2020, 4:47 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'full_name',
        'nick_name',
        'type',
        'phone',
        'gender',
        'about_me',
        'city',
        'country',
        'dob',
        'created_at'
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
        return User::class;
    }
}
