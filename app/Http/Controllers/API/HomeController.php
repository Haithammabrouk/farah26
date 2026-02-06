<?php

namespace App\Http\Controllers\API;

use App\Coupon;
use App\CouponUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Mail;

use App\Models\Trip;
use App\Models\AdditionalTrip;
use App\Models\Country;
use App\Models\Reservation;
use App\Models\Accommodation;
use App\Models\ReservedAdditionalTrip;
use App\Models\User;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\Contactus;
use App\Models\Facility;
use App\Models\Info;
use App\Models\TripCategory;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\Deck;
use App\Models\Partner;
use App\Models\SliderPhoto;
use App\Models\Tripadvisor;
use App\Models\Unique;
use App\Models\meta;
use App\Models\ClosedDates;
use App\Helpers\PaymentTrait;
use App\Mail\SendMail;
use App\Mail\ReservationBooked;
use App\Models\ClosedCabin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use PaymentTrait;

    public function trips(Request $request)
    {

        $request->validate([
            'check_in' => 'before:check_out',
            'check_out' => 'after:check_in',
        ]);


        $tripsQuery = Trip::with('tripCategory');


        if (request()->filled('check_in') && request()->filled('check_out')) {
            $tripsQuery->whereDate('check_in', '>=', request('check_in'))
                ->whereDate('check_out', '<=', request('check_out'));
        } else {
            $tripsQuery->whereDate('check_in', '>=', now())->where('is_home', 1);
        }

        $trips = $tripsQuery->get();


        return response()->json(compact('trips'));
    }

    public function additionalTrips()
    {
        $additionalTrips = AdditionalTrip::with('additionalTripsPhotos')->get();

        return response()->json(compact('additionalTrips'));
    }

    public function tripAdditionals($tripId)
    {
        $trip = Trip::find($tripId);

        // return $trip ;
        $tripAdditionals = $trip->tripsAdditionals;

        return response()->json(compact('tripAdditionals'));
    }

    public function countries(Request $request)
    {
        $countries = Country::all();

        return response()->json(compact('countries'));
    }

    public function removePendingReservation()
    {
        Reservation::whereNull('status')->whereDate('created_at', '<=', now()->subDay())->delete();
    }


    public function getReserved($tripId)
{
    $this->removePendingReservation();

    $trip = Trip::with('closedCabins', 'accommodations')->findOrFail($tripId);

    /* ===============================
       1️⃣ كل الكابنز الموجودة على المركب
    =============================== */
    $allCabins = [
        401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413,
        414, 415, 416, 417, 418, 419, 420, 421, 422, 423, 424, 425, 426,
        301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313,
        314, 315, 316, 317, 318, 319, 320, 321, 322, 323, 324, 325, 326,
        201, 202, 203, 204, 205, 206,
        101, 102, 103, 104, 105, 106
    ];

    /* ===============================
       2️⃣ الكابنز اللي الأدمن اختارها (OPEN)
       ← محفوظة غلط باسم closed_cabins
    =============================== */
    $adminOpenedCabins = $trip->closedCabins()
        ->where('from', $trip->check_in)
        ->where('to', $trip->check_out)
        ->pluck('cabin_num')
        ->toArray();

    /* ===============================
       3️⃣ الكابنز المحجوزة فعليًا
    =============================== */
    $reservedCabins = $trip->accommodations
        ->pluck('accommodation_num')
        ->toArray();

    /* ===============================
       4️⃣ المفتوح = اللي الأدمن اختاره - اللي اتحجز
    =============================== */
    $openedCabins = array_diff($adminOpenedCabins, $reservedCabins);

    /* ===============================
       5️⃣ المغلق = كل الكابنز - المفتوح - المحجوز
    =============================== */
    $closedCabins = array_diff($allCabins, $openedCabins, $reservedCabins);

    return response()->json([
        'opened_cabins'   => array_values($openedCabins),
        'reserved_cabins' => array_values($reservedCabins),
        'closed_cabins'   => array_values($closedCabins),
    ]);
}


    public function addReservation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'     => 'required',
            'last_name'      => 'required',
            'title'          => 'required',
            'mobile'         => 'required',
            'email'          => 'required',
            'country_id'     => 'required',
            'trip_id'        => 'required',
            'accommodations' => 'required',
            'coupon'         => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }
    
        $accommodations  = json_decode(request('accommodations'));
        $additionalTrips = request()->filled('additional_trips') ? json_decode(request('additional_trips')) : [];
    
        $trip = Trip::find(request('trip_id'));
        if (!$trip) {
            return response()->json(["msg" => "Trip not found"], 404);
        }
    
        // ---------------------------------------------
        // (0) Prevent Booking Closed or Already Reserved Cabins
        // ---------------------------------------------
        foreach ($accommodations as $acc) {
    
            // 1) Check if cabin is CLOSED
            // $isClosed = ClosedCabin::where('trip_id', $trip->id)
            //     ->where('cabin_num', $acc->accommodation_num)
            //     ->where('from', $trip->check_in)
            //     ->where('to', $trip->check_out)
            //     ->exists();
    
            // if ($isClosed) {
            //     return response()->json([
            //         "msg" => "Cabin {$acc->accommodation_num} is closed and unavailable."
            //     ], 400);
            // }
            // ✅ الكابينة لازم تكون ضمن اللي الأدمن فتحها
                $isOpen = ClosedCabin::where('trip_id', $trip->id)
                            ->where('cabin_num', $acc->accommodation_num)
                            ->where('from', $trip->check_in)
                            ->where('to', $trip->check_out)
                            ->exists();
                
                if (!$isOpen) {
                    return response()->json([
                        "msg" => "Cabin {$acc->accommodation_num} is closed and unavailable."
                    ], 400);
                }
                    
            // 2) Check if cabin is ALREADY RESERVED
            $isTaken = Accommodation::whereHas('reservation', function ($q) use ($trip) {
                    $q->where('trip_id', $trip->id)
                      ->where('status', '!=', 0);  // status 0 = failed payment
                })
                ->where('accommodation_num', $acc->accommodation_num)
                ->exists();
    
            if ($isTaken) {
                return response()->json([
                    "msg" => "Cabin {$acc->accommodation_num} is already booked."
                ], 400);
            }
    
            // 3) Prevent race condition (pending reservation window)
            $pending = Accommodation::whereHas('reservation', function ($q) use ($trip) {
                    $q->where('trip_id', $trip->id)
                      ->whereNull('status')
                      ->where('created_at', '>=', now()->subMinutes(5));
                })
                ->where('accommodation_num', $acc->accommodation_num)
                ->exists();
    
            if ($pending) {
                return response()->json([
                    "msg" => "Cabin {$acc->accommodation_num} is temporarily locked due to another pending reservation."
                ], 400);
            }
        }
    
        // -----------------------------------------------
        // (1) CHECK CABIN/SUITE AVAILABILITY
        // -----------------------------------------------
        $cabinNeeded = 0;
        $suiteNeeded = 0;
    
        foreach ($accommodations as $acc) {
            if ($acc->type == 1) $cabinNeeded++;
            if ($acc->type == 2) $suiteNeeded++;
        }
    
        if ($cabinNeeded > 0 && $trip->cabin_available < $cabinNeeded) {
            return response()->json([
                "msg" => "Not enough cabins available. Only {$trip->cabin_available} left."
            ], 400);
        }
    
        if ($suiteNeeded > 0 && $trip->suite_available < $suiteNeeded) {
            return response()->json([
                "msg" => "Not enough suites available. Only {$trip->suite_available} left."
            ], 400);
        }
    
        // -----------------------------------------------
        // (2) RESERVE INVENTORY
        // -----------------------------------------------
        if ($cabinNeeded > 0) $trip->decrement('cabin_available', $cabinNeeded);
        if ($suiteNeeded > 0) $trip->decrement('suite_available', $suiteNeeded);
    
        // -----------------------------------------------
        // (3) COUPON LOGIC (UNCHANGED)
        // -----------------------------------------------
        if (request('coupon') != "no_coupon") {
            $check = Coupon::where("coupon_code", request('coupon'))->first();
    
            if (!$check) {
                return response()->json(["msg" => "coupon is not found !"], 404);
            }
    
            if ($check->created_at > Carbon::now() || $check->usage_count >= $check->usage_limit) {
                return response()->json(["msg" => "coupon is invalid !"], 404);
            }
    
            foreach ($check->coupon_users as $usage) {
                if ($usage->user_mobile == request('mobile')) {
                    return response()->json(["msg" => "this user has used this coupon before !"], 404);
                }
            }
    
            foreach ($check->related_trips as $trips) {
                if ($trips->coupon_id == $check->id) {
                    $check->update([
                        "usage_count" => $check->usage_count++
                    ]);
    
                    CouponUsers::create([
                        "user_mobile" => request('mobile'),
                        "coupon_id"   => $check->id
                    ]);
                }
            }
        }
    
        // -----------------------------------------------
        // (4) CREATE USER + RESERVATION
        // -----------------------------------------------
        $user = User::create($request->all());
    
        $request['user_id'] = $user->id;
        $request['uuid']    = uniqid();
        $reservation        = Reservation::create($request->all());
    
        // -----------------------------------------------
        // (5) CALCULATE TOTAL PRICE
        // -----------------------------------------------
        $allPrice = 0;
    
        foreach ($accommodations as $accommodation) {
            $cPrice = $trip->cabin_price;
            $sPrice = $trip->suite_price;
            $cPrice_single = $trip->single_cabin_price;
            $sPrice_single = $trip->single_suite_price;
    
            $child1 = $accommodation->child1_age;
            $child2 = $accommodation->child2_age;
    
            $price_double = $accommodation->type == 1 ? $cPrice : $sPrice;
            $price_single = $accommodation->type == 1 ? $cPrice_single : $sPrice_single;
    
            $totalPrice = $accommodation->adults_count > 1 ? $price_double : $price_single;
            $totalPrice += ($child1 && $child1 == 2) ? $price_double * 0.25 : 0;
            $totalPrice += ($child2 && $child2 == 2) ? $price_double * 0.25 : 0;
    
            if (request('coupon') != "no_coupon") {
                $totalPrice -= (($check->discount * $totalPrice) / 100);
            }
    
            $allPrice += $totalPrice;
    
            Accommodation::create([
                'reservation_id' => $reservation->id,
                'type' => $accommodation->type,
                'accommodation_num' => $accommodation->accommodation_num,
                'guest_name' => $accommodation->guest_name,
                'adults_count' => $accommodation->adults_count,
                'children_count' => $accommodation->children_count,
                'child1_age' => $child1,
                'child2_age' => $child2,
                'cabin_price' => $cPrice,
                'suite_price' => $sPrice,
                'single_cabin_price' => $cPrice_single,
                'single_suite_price' => $sPrice_single,
                'total_price' => $totalPrice,
                "discount" => request('coupon') != "no_coupon" ? $check->discount : 0
            ]);
        }
    
        foreach ($additionalTrips as $additionalTrip) {
            $aTrip = AdditionalTrip::find($additionalTrip->id);
    
            $aPrice = $aTrip->price;
            $aSinglePrice = $aTrip->SinglePrice;
    
            $adults_count = $additionalTrip->adultCount;
            $child1_count = $additionalTrip->child1Count;
            $child2_count = $additionalTrip->child2Count;
    
            if ($adults_count == 1) {
                $totalPrice = $aSinglePrice * $adults_count;
            } else {
                $totalPrice = $aPrice * $adults_count;
            }
    
            $totalPrice += $aPrice * $child1_count * 0.5;
    
            if (request('coupon') != "no_coupon") {
                $totalPrice -= (($check->discount * $totalPrice) / 100);
            }
    
            $allPrice += $totalPrice;
    
            ReservedAdditionalTrip::create([
                'reservation_id' => $reservation->id,
                'additional_trip_id' => $additionalTrip->id,
                'price' => $aPrice,
                'SinglePrice' => $aSinglePrice,
                'adults_count' => $adults_count,
                'child1_count' => $child1_count,
                'child2_count' => $child2_count,
                'total_price' => $totalPrice,
            ]);
        }
    
        // -----------------------------------------------
        // (6) UPDATE RESERVATION PRICE
        // -----------------------------------------------
        $reservation->update([
            'price' => $allPrice,
            'ip_address' => request()->ip()
        ]);
    
        // -----------------------------------------------
        // (7) PAYMENT DATA
        // -----------------------------------------------
        $reference_number = $reservation->id;
        $transaction_uuid = $reservation->uuid;
    
        $online_payment_data = $this->online_payment_data($allPrice, $reference_number, $transaction_uuid, $user);
        $signature = $this->signature($online_payment_data);
    
        $reservation = $reservation->load(
            'user.country',
            'trip.tripCategory',
            'accommodations',
            'reservedAdditionalTrips.additionalTrip'
        );
    
        return response()->json(compact('reservation', 'online_payment_data', 'signature'));
    }



    public function gallery(Request $request)
    {
        $gallery = Gallery::where('status', 1)
            ->whereHas('gallery_photos', function (Builder $query) {
                if (request('type') == 'media') {
                    $query->whereNotNull('url');
                } else {
                    $query->whereNotNull('photo');
                }
            })
            ->with(['gallery_photos' => function ($query) {
                if (request('type') == 'media') {
                    $query->whereNotNull('url');
                } else {
                    $query->whereNotNull('photo');
                }
            }])->get();

        return response()->json(compact('gallery'));
    }

    public function facilities(Request $request)
    {
        $facilities = Facility::with('facilityPhotos')->get();

        return response()->json(compact('facilities'));
    }

    public function infos(Request $request)
    {
        $infos = Info::all();

        $farahMeaning = Page::find(9);

        // return $farahMeaning;

        $contacts = Page::whereIn('id', ['11', '12', '13', '14', '15'])->get();

        return response()->json(compact('infos', 'farahMeaning', 'contacts'));
    }

    public function itineraries(Request $request)
    {
        $itineraries = TripCategory::with('itineraries.itineraryDetails')->get();


        return response()->json(compact('itineraries'));
    }

    public function contactus(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'message' => 'required',
        ]);

        $contactus = Contactus::create($request->all());

        $data = [
            'message' => 'new contact us message from: ' . request('name'),
        ];

        Mail::to('info@farahnilecruise.com')->send(new SendMail($data));

        $data = [
            'message' => 'Many Thanks for contacting us via the website.
            Your message has been received by Farah Nile Cruise Management.
            Please expect to receive our reply ASAP.
            Business hours are Sunday to Thursday from 09:00 am to 18:00 pm (Cairo Local time),
            Telephone number: +20 2 22731921 - 01121479292Email: info@farahnilecruise.com',
        ];
        Mail::to(request('email'))->send(new SendMail($data));

        return response()->json(compact('contactus'));
    }

    public function newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $newsletter = Newsletter::create($request->all());

        return response()->json(compact('newsletter'));
    }

    public function pages($id)
    {
        $page = Page::find($id)->content;

        return response()->json(compact('page'));
    }

    public function decks()
    {
        $decks = Deck::all();

        return response()->json(compact('decks'));
    }

    public function homePage()
    {
        $galleryHome = Gallery::where('status', 1)
            ->with('gallery_photos')
            ->get();


        $partners = Partner::all();

        $facilityHome = Page::find(7);

        $unique = Unique::all();

        $tripadvisor = Tripadvisor::all();

        $sliderPhotos = SliderPhoto::all()->pluck('photo');

        $uniquePhoto = Page::find(16);

        return response()->json([
            'homeGallery' => [
                'cabin' => $galleryHome->where('id', 9)->first(),
                'suite' => $galleryHome->where('id', 10)->first(),
                'lounge' => $galleryHome->where('id', 12)->first(),
                'stairs' => $galleryHome->where('id', 11)->first(),
                'sundeck' => $galleryHome->where('id', 7)->first(),
            ],
            'partners' => $partners,
            'facilityHome' => $facilityHome,
            'unique' => $unique,
            'tripadvisor' => $tripadvisor,
            'sliderPhotos' => $sliderPhotos,
            'uniquePhoto' => $uniquePhoto,
        ]);
    }

    public function getCheckout($reservationId)
    {
        $reservation = Reservation::with('user.country', 'trip.tripCategory', 'accommodations', 'reservedAdditionalTrips')->find($reservationId);

        $reference_number = $reservation->id;
        $allPrice = $reservation->price;
        $transaction_uuid = $reservation->uuid;

        $user = $reservation->user;

        $online_payment_data = $this->online_payment_data($allPrice, $reference_number, $transaction_uuid, $user);

        $signature = $this->signature($online_payment_data);

        return response()->json(compact('reservation', 'online_payment_data', 'signature'));
    }

    public function paymentResponse(Request $request)
    {


        $reservation = Reservation::find(request('req_reference_number'));

        $reservation->update([
            'status' => request('reason_code') == 100 ? 1 : 0,
            'payment_res_code' => request('reason_code'),
            'payment_res_msg' => request('message'),
            'payment_res_full' => json_encode(request()->all()),
        ]);

        Accommodation::where('reservation_id', $reservation->id)->update(['status' => $reservation->status]);

        ReservedAdditionalTrip::where('reservation_id', $reservation->id)->update(['status' => $reservation->status]);

        if ($reservation->status == 1) {
            $cCount = Accommodation::where('reservation_id', $reservation->id)->where('type', 1)->count();
            $sCount = Accommodation::where('reservation_id', $reservation->id)->where('type', 2)->count();

            $trip = Trip::find($reservation->trip_id);
            $trip->decrement('cabin_available', $cCount);
            $trip->decrement('suite_available', $sCount);

            Mail::to($reservation->user->email)
                ->cc(['reservation@farahnilecruise.com', 'info@farahnilecruise.com', 'Accounting@farahnilecruise.com'])
                ->send(new ReservationBooked($reservation));
        }

        return 'ok';
    }

    public function metas()
    {
        $metas = meta::all();

        return response()->json(compact('metas'));
    }

    public function closedDates()
    {
        $closedDates = ClosedDates::pluck('date')->toArray();

        return response()->json(compact('closedDates'));
    }

    public function applyCoupon($coupon, $trip_id, $user_mobile)
    {
        // check if coupon found or not
        $check = Coupon::where("coupon_code", $coupon)->first();

        if (!$check) {
            return response()->json(["msg" => "coupon is not found !"], 404);
        }


        // check if coupon is valid or not
        if ($check->created_at > Carbon::now() || $check->usage_count >= $check->usage_limit) {
            return response()->json(["msg" => "coupon is invalid !"], 404);
        }

        // check if user has used this coupon ==> [note] user should use this coupon once one time
        foreach ($check->coupon_users as $usage) {
            if ($usage->user_mobile == $user_mobile) {
                return response()->json(["msg" => "this user has used this coupon before !"], 404);
            }
        }

        return response($check);
        // check if trip related to coupon
        // if( $check-> )
    }

    
  

}
