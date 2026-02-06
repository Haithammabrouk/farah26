<?php

namespace App\Repositories\AdminPanel;

use App\Models\Newsletter;
use App\Repositories\BaseRepository;

/**
 * Class NewsletterRepository
 * @package App\Repositories\AdminPanel
 * @version August 25, 2020, 3:48 pm UTC
*/

class NewsletterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email'
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
        return Newsletter::class;
    }
}
