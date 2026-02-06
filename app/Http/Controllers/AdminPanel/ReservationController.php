<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateReservationRequest;
use App\Http\Requests\AdminPanel\UpdateReservationRequest;
use App\Repositories\AdminPanel\ReservationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Reservation;

class ReservationController extends AppBaseController
{
    /** @var  ReservationRepository */
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepo)
    {
        $this->reservationRepository = $reservationRepo;
    }

    /**
     * Display a listing of the Reservation.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $reservations = $this->reservationRepository->searchWithRelations($search, 10);

        return view('adminPanel.reservations.index')
            ->with('reservations', $reservations)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new Reservation.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.reservations.create');
    }

    /**
     * Store a newly created Reservation in storage.
     *
     * @param CreateReservationRequest $request
     *
     * @return Response
     */
    public function store(CreateReservationRequest $request)
    {
        $input = $request->all();

        $reservation = $this->reservationRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/reservations.singular')]));

        return redirect(route('adminPanel.reservations.index'));
    }

    /**
     * Display the specified Reservation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reservation = Reservation::with('accommodations', 'reservedAdditionalTrips')->find($id);

        // return $reservation->trip_id ;

        // get check in and check out
        $dates = Reservation::join('trips' , 'trips.id' , '=' , 'reservations.trip_id')
        ->where('reservations.id' , $id)
        ->select('trips.check_in' , 'trips.check_out')->get();


        if (empty($reservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservations.singular')]));

            return redirect(route('adminPanel.reservations.index'));
        }

        return view('adminPanel.reservations.show')
        ->with('reservation', $reservation)
        ->with('dates', $dates[0]);
    }

    /**
     * Show the form for editing the specified Reservation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservations.singular')]));

            return redirect(route('adminPanel.reservations.index'));
        }

        return view('adminPanel.reservations.edit')->with('reservation', $reservation);
    }

    /**
     * Update the specified Reservation in storage.
     *
     * @param int $id
     * @param UpdateReservationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReservationRequest $request)
    {
        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservations.singular')]));

            return redirect(route('adminPanel.reservations.index'));
        }

        $reservation = $this->reservationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/reservations.singular')]));

        return redirect(route('adminPanel.reservations.index'));
    }

    /**
     * Remove the specified Reservation from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {

        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservations.singular')]));

            return redirect(route('adminPanel.reservations.index'));
        }

        $this->reservationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/reservations.singular')]));

        return redirect(route('adminPanel.reservations.index'));
    }
}
