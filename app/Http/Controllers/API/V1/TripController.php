<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\AdditionalTrip;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TripController extends Controller
{
    /**
     * Get all trips with optional date filtering
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $request->validate([
            'check_in' => 'nullable|date|before:check_out',
            'check_out' => 'nullable|date|after:check_in',
        ]);

        $tripsQuery = Trip::with('tripCategory');

        if ($request->filled('check_in') && $request->filled('check_out')) {
            $tripsQuery->whereDate('check_in', '>=', $request->check_in)
                ->whereDate('check_out', '<=', $request->check_out);
        } else {
            $tripsQuery->whereDate('check_in', '>=', now())->where('is_home', 1);
        }

        $trips = $tripsQuery->get();

        return response()->json([
            'success' => true,
            'data' => $trips
        ]);
    }

    /**
     * Get additional trips for a specific trip
     *
     * @param int $tripId
     * @return \Illuminate\Http\JsonResponse
     */
    public function additionals($tripId)
    {
        $trip = Trip::findOrFail($tripId);
        $tripAdditionals = $trip->tripsAdditionals;

        return response()->json([
            'success' => true,
            'data' => $tripAdditionals
        ]);
    }

    /**
     * Get available/reserved/closed cabins for a trip
     *
     * @param int $tripId
     * @return \Illuminate\Http\JsonResponse
     */
    public function cabinAvailability($tripId)
    {
        // Remove pending reservations first
        $this->removePendingReservations();

        $trip = Trip::with('closedCabins', 'accommodations')->findOrFail($tripId);

        // All cabins on the ship
        $allCabins = [
            401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413,
            414, 415, 416, 417, 418, 419, 420, 421, 422, 423, 424, 425, 426,
            301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313,
            314, 315, 316, 317, 318, 319, 320, 321, 322, 323, 324, 325, 326,
            201, 202, 203, 204, 205, 206,
            101, 102, 103, 104, 105, 106
        ];

        // Admin opened cabins
        $adminOpenedCabins = $trip->closedCabins()
            ->where('from', $trip->check_in)
            ->where('to', $trip->check_out)
            ->pluck('cabin_num')
            ->toArray();

        // Actually reserved cabins
        $reservedCabins = $trip->accommodations
            ->pluck('accommodation_num')
            ->toArray();

        // Available = Admin opened - Reserved
        $openedCabins = array_diff($adminOpenedCabins, $reservedCabins);

        // Closed = All - Available - Reserved
        $closedCabins = array_diff($allCabins, $openedCabins, $reservedCabins);

        return response()->json([
            'success' => true,
            'data' => [
                'opened_cabins' => array_values($openedCabins),
                'reserved_cabins' => array_values($reservedCabins),
                'closed_cabins' => array_values($closedCabins),
            ]
        ]);
    }

    /**
     * Get all additional trips
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function allAdditionalTrips()
    {
        $additionalTrips = AdditionalTrip::with('additionalTripsPhotos')->get();

        return response()->json([
            'success' => true,
            'data' => $additionalTrips
        ]);
    }

    /**
     * Remove pending reservations older than 30 minutes
     *
     * @return void
     */
    protected function removePendingReservations()
    {
        Reservation::whereNull('status')
            ->where('created_at', '<', Carbon::now()->subMinutes(30))
            ->delete();
    }
}
