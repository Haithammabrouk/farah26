<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Trip;
use App\Models\User;
use App\Models\Accommodation;
use App\Models\ReservedAdditionalTrip;
use App\Models\ClosedCabin;
use App\Coupon;
use App\CouponUsers;
use App\Helpers\PaymentTrait;
use App\Mail\ReservationBooked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ReservationController extends Controller
{
    use PaymentTrait;

    /**
     * Create a new reservation
     * NOTE: This is a copy of the original addReservation method from HomeController
     * Kept as-is to maintain backward compatibility
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'first_name'     => 'required',
            'last_name'      => 'required',
            'title'          => 'required',
            'mobile'         => 'required',
            'email'          => 'required|email',
            'country_id'     => 'required',
            'trip_id'        => 'required|exists:trips,id',
            'accommodations' => 'required',
            'coupon'         => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // NOTE: The complete implementation is in HomeController@addReservation (line 153-420)
        // For now, this delegates to the original method to avoid duplication
        // In a full refactor, this code would be moved here completely

        $homeController = app(\App\Http\Controllers\API\HomeController::class);
        return $homeController->addReservation($request);
    }

    /**
     * Get checkout details for a reservation
     *
     * @param int $reservationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout($reservationId)
    {
        $reservation = Reservation::with(['accommodations', 'reservedAdditionalTrips', 'trip'])
            ->findOrFail($reservationId);

        return response()->json([
            'success' => true,
            'data' => $reservation
        ]);
    }

    /**
     * Handle payment response from payment gateway
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentResponse(Request $request)
    {
        // NOTE: The complete implementation is in HomeController@paymentResponse (line 579-610)
        // Delegates to original method to avoid duplication

        $homeController = app(\App\Http\Controllers\API\HomeController::class);
        return $homeController->paymentResponse($request);
    }
}
