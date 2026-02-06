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

    /**
     * Search reservations with user relationship fields
     *
     * @param string|null $search
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchWithRelations($search = null, $perPage = 10)
    {
        $query = $this->model->newQuery()
            ->with(['user', 'trip.tripCategory'])
            ->latest();

        if ($search && !empty(trim($search))) {
            $query->where(function($q) use ($search) {
                // Search in user fields
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where(function($uq) use ($search) {
                        $uq->where('first_name', 'LIKE', "%{$search}%")
                           ->orWhere('last_name', 'LIKE', "%{$search}%")
                           ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                           ->orWhere('email', 'LIKE', "%{$search}%")
                           ->orWhere('mobile', 'LIKE', "%{$search}%");
                    });
                });

                // Also search in reservation fields
                $q->orWhere('uuid', 'LIKE', "%{$search}%")
                  ->orWhere('comment', 'LIKE', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }
}
