<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateReservedAdditionalTripRequest;
use App\Http\Requests\AdminPanel\UpdateReservedAdditionalTripRequest;
use App\Repositories\AdminPanel\ReservedAdditionalTripRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ReservedAdditionalTripController extends AppBaseController
{
    /** @var  ReservedAdditionalTripRepository */
    private $reservedAdditionalTripRepository;

    public function __construct(ReservedAdditionalTripRepository $reservedAdditionalTripRepo)
    {
        $this->reservedAdditionalTripRepository = $reservedAdditionalTripRepo;
    }

    /**
     * Display a listing of the ReservedAdditionalTrip.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $reservedAdditionalTrips = $this->reservedAdditionalTripRepository->paginate(10);

        return view('adminPanel.reserved_additional_trips.index')
            ->with('reservedAdditionalTrips', $reservedAdditionalTrips);
    }

    /**
     * Show the form for creating a new ReservedAdditionalTrip.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.reserved_additional_trips.create');
    }

    /**
     * Store a newly created ReservedAdditionalTrip in storage.
     *
     * @param CreateReservedAdditionalTripRequest $request
     *
     * @return Response
     */
    public function store(CreateReservedAdditionalTripRequest $request)
    {
        $input = $request->all();

        $reservedAdditionalTrip = $this->reservedAdditionalTripRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/reservedAdditionalTrips.singular')]));

        return redirect(route('adminPanel.reservedAdditionalTrips.index'));
    }

    /**
     * Display the specified ReservedAdditionalTrip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reservedAdditionalTrip = $this->reservedAdditionalTripRepository->find($id);

        if (empty($reservedAdditionalTrip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservedAdditionalTrips.singular')]));

            return redirect(route('adminPanel.reservedAdditionalTrips.index'));
        }

        return view('adminPanel.reserved_additional_trips.show')->with('reservedAdditionalTrip', $reservedAdditionalTrip);
    }

    /**
     * Show the form for editing the specified ReservedAdditionalTrip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reservedAdditionalTrip = $this->reservedAdditionalTripRepository->find($id);

        if (empty($reservedAdditionalTrip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservedAdditionalTrips.singular')]));

            return redirect(route('adminPanel.reservedAdditionalTrips.index'));
        }

        return view('adminPanel.reserved_additional_trips.edit')->with('reservedAdditionalTrip', $reservedAdditionalTrip);
    }

    /**
     * Update the specified ReservedAdditionalTrip in storage.
     *
     * @param int $id
     * @param UpdateReservedAdditionalTripRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReservedAdditionalTripRequest $request)
    {
        $reservedAdditionalTrip = $this->reservedAdditionalTripRepository->find($id);

        if (empty($reservedAdditionalTrip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservedAdditionalTrips.singular')]));

            return redirect(route('adminPanel.reservedAdditionalTrips.index'));
        }

        $reservedAdditionalTrip = $this->reservedAdditionalTripRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/reservedAdditionalTrips.singular')]));

        return redirect(route('adminPanel.reservedAdditionalTrips.index'));
    }

    /**
     * Remove the specified ReservedAdditionalTrip from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reservedAdditionalTrip = $this->reservedAdditionalTripRepository->find($id);

        if (empty($reservedAdditionalTrip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservedAdditionalTrips.singular')]));

            return redirect(route('adminPanel.reservedAdditionalTrips.index'));
        }

        $this->reservedAdditionalTripRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/reservedAdditionalTrips.singular')]));

        return redirect(route('adminPanel.reservedAdditionalTrips.index'));
    }
}
