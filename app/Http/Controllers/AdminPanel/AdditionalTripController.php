<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateAdditionalTripRequest;
use App\Http\Requests\AdminPanel\UpdateAdditionalTripRequest;
use App\Repositories\AdminPanel\AdditionalTripRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\TripCategory;

class AdditionalTripController extends AppBaseController
{
    /** @var  AdditionalTripRepository */
    private $additionalTripRepository;

    public function __construct(AdditionalTripRepository $additionalTripRepo)
    {
        $this->additionalTripRepository = $additionalTripRepo;
    }

    /**
     * Display a listing of the AdditionalTrip.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $additionalTrips = $this->additionalTripRepository->paginate(10);

        return view('adminPanel.additional_trips.index')
            ->with('additionalTrips', $additionalTrips);
    }

    /**
     * Show the form for creating a new AdditionalTrip.
     *
     * @return Response
     */
    public function create()
    {
        $tripCategories = TripCategory::get()->pluck('name', 'id');

        return view('adminPanel.additional_trips.create', compact('tripCategories'));
    }

    /**
     * Store a newly created AdditionalTrip in storage.
     *
     * @param CreateAdditionalTripRequest $request
     *
     * @return Response
     */
    public function store(CreateAdditionalTripRequest $request)
    {
        $input = $request->all();

        $additionalTrip = $this->additionalTripRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/additionalTrips.singular')]));

        return redirect(route('adminPanel.additionalTrips.index'));
    }

    /**
     * Display the specified AdditionalTrip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $additionalTrip = $this->additionalTripRepository->find($id);

        if (empty($additionalTrip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionalTrips.singular')]));

            return redirect(route('adminPanel.additionalTrips.index'));
        }

        return view('adminPanel.additional_trips.show')->with('additionalTrip', $additionalTrip);
    }

    /**
     * Show the form for editing the specified AdditionalTrip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $additionalTrip = $this->additionalTripRepository->find($id);

        if (empty($additionalTrip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionalTrips.singular')]));

            return redirect(route('adminPanel.additionalTrips.index'));
        }

        $tripCategories = TripCategory::get()->pluck('name', 'id');

        return view('adminPanel.additional_trips.edit', compact('additionalTrip', 'tripCategories'));
    }

    /**
     * Update the specified AdditionalTrip in storage.
     *
     * @param int $id
     * @param UpdateAdditionalTripRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdditionalTripRequest $request)
    {
        $additionalTrip = $this->additionalTripRepository->find($id);

        if (empty($additionalTrip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionalTrips.singular')]));

            return redirect(route('adminPanel.additionalTrips.index'));
        }

        $additionalTrip = $this->additionalTripRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/additionalTrips.singular')]));

        return redirect(route('adminPanel.additionalTrips.index'));
    }

    /**
     * Remove the specified AdditionalTrip from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $additionalTrip = $this->additionalTripRepository->find($id);

        if (empty($additionalTrip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionalTrips.singular')]));

            return redirect(route('adminPanel.additionalTrips.index'));
        }

        $this->additionalTripRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/additionalTrips.singular')]));

        return redirect(route('adminPanel.additionalTrips.index'));
    }
}
