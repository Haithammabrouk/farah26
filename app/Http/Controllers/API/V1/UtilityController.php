<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\meta;
use App\Models\ClosedDates;
use App\Coupon;
use App\CouponUsers;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    /**
     * Get all countries
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function countries(Request $request)
    {
        $countries = Country::all();

        return response()->json([
            'success' => true,
            'data' => $countries
        ]);
    }

    /**
     * Get all meta tags
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function metas()
    {
        $metas = meta::all();

        return response()->json([
            'success' => true,
            'data' => $metas
        ]);
    }

    /**
     * Get all closed dates
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function closedDates()
    {
        $closedDates = ClosedDates::all();

        return response()->json([
            'success' => true,
            'data' => $closedDates
        ]);
    }

    /**
     * Apply a coupon code
     *
     * @param string $coupon
     * @param int $tripId
     * @param string $userMobile
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyCoupon($coupon, $tripId, $userMobile)
    {
        $couponData = Coupon::where('code', $coupon)
            ->where('trip_id', $tripId)
            ->first();

        if (!$couponData) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code or trip.'
            ], 404);
        }

        // Check if coupon already used by this user
        $alreadyUsed = CouponUsers::where('coupon_id', $couponData->id)
            ->where('mobile', $userMobile)
            ->exists();

        if ($alreadyUsed) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon already used by this user.'
            ], 400);
        }

        // Check coupon usage limit
        $usageCount = CouponUsers::where('coupon_id', $couponData->id)->count();

        if ($usageCount >= $couponData->number_of_users) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon usage limit reached.'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'coupon' => $couponData,
                'discount' => $couponData->discount_percentage ?? $couponData->discount_amount
            ]
        ]);
    }
}
