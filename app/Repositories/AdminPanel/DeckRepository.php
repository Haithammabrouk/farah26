<?php

namespace App\Repositories\AdminPanel;

use App\Models\Deck;
use App\Repositories\BaseRepository;

/**
 * Class DeckRepository
 * @package App\Repositories\AdminPanel
 * @version August 31, 2020, 3:34 pm UTC
*/

class DeckRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'file'
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
        return Deck::class;
    }
}
