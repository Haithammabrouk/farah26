<?php

namespace App\Repositories\AdminPanel;

use App\Models\Reservation;
use App\Repositories\BaseRepository;

/**
 * Class ReservationRepository
 * @package App\Repositories\AdminPanel
 * @version July 28, 2020, 6:14 pm UTC
*/

class ReservationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'trip_id',
        'user_id',
        'comment',
        'status'
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
        return Reservation::class;
    }
}
