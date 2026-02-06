<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateAdditionalTripsPhotosRequest;
use App\Http\Requests\AdminPanel\UpdateAdditionalTripsPhotosRequest;
use App\Repositories\AdminPanel\AdditionalTripsPhotosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\AdditionalTrip;
use App\Models\AdditionalTripsPhotos;

class AdditionalTripsPhotosController extends AppBaseController
{
    /** @var  AdditionalTripsPhotosRepository */
    private $additionalTripsPhotosRepository;

    public function __construct(AdditionalTripsPhotosRepository $additionalTripsPhotosRepo)
    {
        $this->additionalTripsPhotosRepository = $additionalTripsPhotosRepo;
    }

    /**
     * Display a listing of the AdditionalTripsPhotos.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $additionalTripsPhotos = AdditionalTripsPhotos::latest()->paginate(10);

        return view('adminPanel.additional_trips_photos.index')
            ->with('additionalTripsPhotos', $additionalTripsPhotos);
    }

    /**
     * Show the form for creating a new AdditionalTripsPhotos.
     *
     * @return Response
     */
    public function create()
    {
        $additionalTrips = AdditionalTrip::get()->pluck('name', 'id');

        return view('adminPanel.additional_trips_photos.create', compact('additionalTrips'));
    }

    /**
     * Store a newly created AdditionalTripsPhotos in storage.
     *
     * @param CreateAdditionalTripsPhotosRequest $request
     *
     * @return Response
     */
    public function store(CreateAdditionalTripsPhotosRequest $request)
    {
        $input = $request->all();

        $additionalTripsPhotos = $this->additionalTripsPhotosRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/additionalTripsPhotos.singular')]));

        return redirect(route('adminPanel.additionalTripsPhotos.index'));
    }

    /**
     * Display the specified AdditionalTripsPhotos.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $additionalTripsPhotos = $this->additionalTripsPhotosRepository->find($id);

        if (empty($additionalTripsPhotos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionalTripsPhotos.singular')]));

            return redirect(route('adminPanel.additionalTripsPhotos.index'));
        }

        return view('adminPanel.additional_trips_photos.show')->with('additionalTripsPhotos', $additionalTripsPhotos);
    }

    /**
     * Show the form for editing the specified AdditionalTripsPhotos.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $additionalTripsPhotos = $this->additionalTripsPhotosRepository->find($id);

        if (empty($additionalTripsPhotos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionalTripsPhotos.singular')]));

            return redirect(route('adminPanel.additionalTripsPhotos.index'));
        }

        $additionalTrips = AdditionalTrip::get()->pluck('name', 'id');

        return view('adminPanel.additional_trips_photos.edit', compact('additionalTripsPhotos', 'additionalTrips'));
    }

    /**
     * Update the specified AdditionalTripsPhotos in storage.
     *
     * @param int $id
     * @param UpdateAdditionalTripsPhotosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdditionalTripsPhotosRequest $request)
    {
        $additionalTripsPhotos = $this->additionalTripsPhotosRepository->find($id);

        if (empty($additionalTripsPhotos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionalTripsPhotos.singular')]));

            return redirect(route('adminPanel.additionalTripsPhotos.index'));
        }

        $additionalTripsPhotos = $this->additionalTripsPhotosRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/additionalTripsPhotos.singular')]));

        return redirect(route('adminPanel.additionalTripsPhotos.index'));
    }

    /**
     * Remove the specified AdditionalTripsPhotos from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $additionalTripsPhotos = $this->additionalTripsPhotosRepository->find($id);

        if (empty($additionalTripsPhotos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionalTripsPhotos.singular')]));

            return redirect(route('adminPanel.additionalTripsPhotos.index'));
        }

        $this->additionalTripsPhotosRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/additionalTripsPhotos.singular')]));

        return redirect(route('adminPanel.additionalTripsPhotos.index'));
    }
}
