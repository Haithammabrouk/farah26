<?php

namespace App\Http\Controllers\AdminPanel;

use App\Coupon;
use App\CouponTrip;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCouponRequest;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(10);

        foreach( $coupons as $coupon ){
            if( $coupon->created_at < Carbon::now()->toDateString() || $coupon->usage_count >= $coupon->usage_limit ){
                $coupon->update([
                    "active" => 0
                ]);
            }
        }

        return view('adminPanel.coupons.index', compact('coupons'));
    }

    public function add()
    {
        $trips = Trip::get();

        return view('adminPanel.coupons.create', compact('trips'));
    }

    public function store(CreateCouponRequest $request)
    {
        if (!$request->trips && !$request->all_trips) {
            return redirect()->back()->withErrors(["msg" => "please select at least one trip"]);
        }

        if ($request->discount > 100 || $request->discount < 0) {
            return redirect()->back()->withErrors(["msg" => "discount should be less than or equal 100"]);
        }

        if ($request->limit < 0) {
            return redirect()->back()->withErrors(["msg" => "limit should be gratter than 0"]);
        }

        $coupon = Coupon::create([
            "coupon_code" => $request->code,
            "code_duration" => $request->duration,
            "discount" => $request->discount,
            "usage_limit" => $request->limit,
            "active" => $request->activation
        ]);


        if ($request->all_trips) {
            $trips = Trip::get();
            foreach ($trips as $obj2) {
                $coupon_trip = CouponTrip::create([
                    "coupon_id" => $coupon->id,
                    "trip_id" => $obj2->id
                ]);
            }
        } else {
            foreach ($request->trips as $obj) {
                $coupon_trip = CouponTrip::create([
                    "coupon_id" => $coupon->id,
                    "trip_id" => $obj
                ]);
            }
        }


        return redirect("/en/adminPanel/coupons");
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);

        $trips = Trip::get();

        return view('adminPanel.coupons.edit_fields')->with('coupon', $coupon)->with('trips', $trips);
    }

    public function update(CreateCouponRequest $request, $id)
    {
        if (!$request->trips && !$request->all_trips) {
            return redirect()->back()->withErrors(["msg" => "please select at least one trip"]);
        }

        if ($request->discount > 100 || $request->discount < 0) {
            return redirect()->back()->withErrors(["msg" => "discount should be less than or equal 100"]);
        }

        if ($request->limit < 0) {
            return redirect()->back()->withErrors(["msg" => "limit should be gratter than 0"]);
        }

        $this_coupon = Coupon::find($id);

        $coupon = Coupon::find($id)->update([
            "coupon_code" => $request->code,
            "code_duration" => $request->duration,
            "discount" => $request->discount,
            "usage_limit" => $request->limit,
            "active" => $request->activation
        ]);


        foreach( $this_coupon->related_trips as $related_trips ){
            $related_trips->delete();
        }


        if ($request->all_trips) {

            $trips = Trip::get();
            foreach ($trips as $obj2) {
                $coupon_trip = CouponTrip::create([
                    "coupon_id" => $this_coupon->id,
                    "trip_id" => $obj2->id
                ]);
            }
        } else {
            foreach ($request->trips as $obj) {
                $coupon_trip = CouponTrip::create([
                    "coupon_id" => $this_coupon->id,
                    "trip_id" => $obj
                ]);
            }
        }


        return redirect("/en/adminPanel/coupons");
        
    }


    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        foreach ($coupon->related_trips as $obj) {
            $obj->delete();
        }

        $coupon->delete();

        return redirect('/en/adminPanel/coupons');
    }
}
