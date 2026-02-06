<?php

namespace App\Repositories\AdminPanel;

use App\Models\SinglePrice;
use App\Repositories\BaseRepository;

/**
 * Class SinglePriceRepository
 * @package App\Repositories\AdminPanel
 * @version September 27, 2023, 10:45 pm UTC
*/

class SinglePriceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'SinglePrice'
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
        return SinglePrice::class;
    }
}
