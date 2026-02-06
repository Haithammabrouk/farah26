<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateTripRequest;
use App\Http\Requests\AdminPanel\UpdateTripRequest;
use App\Repositories\AdminPanel\TripRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Trip;
use App\Models\TripCategory;
use App\Models\AdditionalTrip;
use App\Models\ClosedCabin;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class TripController extends AppBaseController
{
    /** @var  TripRepository */
    private $tripRepository;

    public function __construct(TripRepository $tripRepo)
    {
        $this->tripRepository = $tripRepo;
    }

    /**
     * Display a listing of the Trip.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $trips = $this->tripRepository->paginate(10);



        return view('adminPanel.trips.index')
            ->with('trips', $trips);
    }

    /**
     * Show the form for creating a new Trip.
     *
     * @return Response
     */
    public function create()
    {
        $tripCategories = TripCategory::get()->pluck('name', 'id');
        $additionalTrips = AdditionalTrip::get();

        return view('adminPanel.trips.create', compact('tripCategories', 'additionalTrips'));
    }

    /**
     * Store a newly created Trip in storage.
     *
     * @param CreateTripRequest $request
     *
     * @return Response
     */
    // public function store(CreateTripRequest $request)
    // {
    //     $input = $request->all();
        


    //     $input['cabin_available'] = $input['cabin_count'];
    //     $input['suite_available'] = $input['suite_count'];
    //     $trip = $this->tripRepository->create($input);

    //     // if (request()->filled('closed_cabins')) {
    //     //     $trip->closedCabins()->createMany(request('closed_cabins'));
    //     // }
    //     if (request()->filled('closed_cabins')) {
        
    //         $data = [];
        
    //         foreach (request('closed_cabins') as $cabin) {
    //             $data[] = [
    //                 'cabin_num' => $cabin['cabin_num'],
    //                 'from'      => $trip->check_in,
    //                 'to'        => $trip->check_out,
    //             ];
    //         }
        
    //         $trip->closedCabins()->createMany($data);
    //     }
        
    //     $openedCabinsCount = count(request('closed_cabins'));

    //     DB::table('trips')
    //         ->where('id', $trip->id)
    //         ->update([
    //             'cabin_count'     => $openedCabinsCount,
    //             'cabin_available' => $openedCabinsCount,
    //         ]);



    //     $trip->tripsAdditionals()->sync(request('additional_trips'));

    //     Flash::success(__('messages.saved', ['model' => __('models/trips.singular')]));

    //     return redirect(route('adminPanel.trips.index'));
    // }
//     public function store(CreateTripRequest $request)
// {
//     $input = $request->all();

//     // إنشاء الرحلة
//     $trip = $this->tripRepository->create($input);

//     $openedCabins = [];

//     /* ===============================
//       حفظ الكابنز المختارة (OPEN)
//     =============================== */
//     if ($request->filled('closed_cabins')) {

//         foreach ($request->closed_cabins as $cabin) {
//             $openedCabins[] = [
//                 'cabin_num' => $cabin['cabin_num'],
//                 'from'      => $trip->check_in,
//                 'to'        => $trip->check_out,
//             ];
//         }

//         $trip->closedCabins()->createMany($openedCabins);
//     }

//     /* ===============================
//       حساب Cabin / Suite Counts
//     =============================== */
//     $suiteNumbers = [401, 402];

//     $suiteCount = collect($openedCabins)
//         ->whereIn('cabin_num', $suiteNumbers)
//         ->count();

//     $cabinCount = count($openedCabins) - $suiteCount;

//     /* ===============================
//       تحديث العدادات (الداشبورد يعتمد عليها)
//     =============================== */
//     DB::table('trips')
//         ->where('id', $trip->id)
//         ->update([
//             'cabin_count'     => $cabinCount,
//             'suite_count'     => $suiteCount,
//             'cabin_available' => $cabinCount,
//             'suite_available' => $suiteCount,
//         ]);

//     /* ===============================
//       Additional Trips
//     =============================== */
//     if ($request->filled('additional_trips')) {
//         $trip->tripsAdditionals()->sync($request->additional_trips);
//     }

//     Flash::success(__('messages.saved', ['model' => __('models/trips.singular')]));

//     return redirect(route('adminPanel.trips.index'));
// }
public function store(CreateTripRequest $request)
{
    $trip = $this->tripRepository->create($request->all());

    $openedCabins = collect($request->closed_cabins ?? [])
        ->map(function ($cabin) use ($trip) {
            return [
                'cabin_num' => $cabin['cabin_num'],
                'from'      => $trip->check_in,
                'to'        => $trip->check_out,
            ];
        });

    // احفظ المفتوح فقط
    if ($openedCabins->isNotEmpty()) {
        $trip->closedCabins()->createMany($openedCabins->toArray());
    }

    // Suites ثابتة
    $suiteNumbers = [401, 402];

    $suiteCount = $openedCabins
        ->whereIn('cabin_num', $suiteNumbers)
        ->count();

    $cabinCount = $openedCabins->count() - $suiteCount;

    // تحديث العدادات (الدashboard يعتمد عليها)
    $trip->update([
        'cabin_count'     => $cabinCount,
        'suite_count'     => $suiteCount,
        'cabin_available' => $cabinCount,
        'suite_available' => $suiteCount,
    ]);

    if ($request->filled('additional_trips')) {
        $trip->tripsAdditionals()->sync($request->additional_trips);
    }

    Flash::success(__('messages.saved', ['model' => __('models/trips.singular')]));
    return redirect(route('adminPanel.trips.index'));
}


    /**
     * Display the specified Trip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //155

        $trip = Trip::with('closedCabins', 'tripsAdditionals')->find($id);


        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));

            return redirect(route('adminPanel.trips.index'));
        }

        return view('adminPanel.trips.show')->with('trip', $trip);
    }

    /**
     * Show the form for editing the specified Trip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $trip = Trip::with('closedCabins', 'accommodations', 'tripsAdditionals')->find($id);
        $closedCabins = $trip->closedCabins()->pluck('cabin_num')->toArray();
        $accommodations = $trip->accommodations()->pluck('accommodation_num')->toArray();
        
        
        $tripsAdditionals = $trip->tripsAdditionals()->pluck('additional_trips.id')->toArray();


        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));

            return redirect(route('adminPanel.trips.index'));
        }

        $tripCategories = TripCategory::get()->pluck('name', 'id');
        $additionalTrips = AdditionalTrip::get();


        return view('adminPanel.trips.edit', compact(
            'trip',
            'closedCabins',
            'accommodations',
            'tripsAdditionals',
            'tripCategories',
            'additionalTrips'
        ));
    }

    /**
     * Update the specified Trip in storage.
     *
     * @param int $id
     * @param UpdateTripRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTripRequest $request)
    {
        
        $trip = $this->tripRepository->find($id);

        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));

            return redirect(route('adminPanel.trips.index'));
        }

        if ($trip->cabin_available == $trip->cabin_count) {
            $request['cabin_available'] = $request['cabin_count'];
        }
        if ($trip->suite_available == $trip->suite_count) {
            $request['suite_available'] = $request['suite_count'];
        }

        $trip = $this->tripRepository->update($request->all(), $id);

        $trip->closedCabins()->delete();


        if (request()->filled('closed_cabins')) {

            $arr = [];

            $suite_count = 0;
            $totalCabins = count(request('closed_cabins'));
            
            foreach (request('closed_cabins') as $obj) {
                    $obj['from'] = $trip->check_in;
                    $obj['to'] = $trip->check_out;
                    $arr[] = $obj;
                }

            for ($i = 0; $i < count(request('closed_cabins')); $i++) {
                


                if (request('closed_cabins')[$i]['cabin_num'] == 401) {
                    $suite_count++;
                }

                if (request('closed_cabins')[$i]['cabin_num'] == 402) {
                    $suite_count++;
                }
            }
            
            $trip->closedCabins()->createMany($arr);


            $cabins_count = $totalCabins - $suite_count;

            // return $cabins_count ;



            DB::table('trips')
                ->where('id', $trip->id)
                ->update([
                    'cabin_count' => $cabins_count,
                    'suite_count' => $suite_count,
                    'cabin_available' => $cabins_count,
                    'suite_available' => $suite_count
                ]);
        } else {
            DB::table('trips')
                ->where('id', $trip->id)
                ->update([
                    'cabin_count' => 0,
                    'suite_count' => 0,
                    'cabin_available' => 0,
                    'suite_available' => 0
                ]);
        }



        $trip->tripsAdditionals()->sync(request('additional_trips'));

        Flash::success(__('messages.updated', ['model' => __('models/trips.singular')]));

        return redirect(route('adminPanel.trips.index'));
    }

    /**
     * Remove the specified Trip from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $trip = $this->tripRepository->find($id);

        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));

            return redirect(route('adminPanel.trips.index'));
        }

        $this->tripRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/trips.singular')]));

        return redirect(route('adminPanel.trips.index'));
    }
}
