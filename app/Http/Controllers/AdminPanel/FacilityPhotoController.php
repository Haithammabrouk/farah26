<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateFacilityPhotoRequest;
use App\Http\Requests\AdminPanel\UpdateFacilityPhotoRequest;
use App\Repositories\AdminPanel\FacilityPhotoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Facility;
use App\Models\FacilityPhoto;

class FacilityPhotoController extends AppBaseController
{
    /** @var  FacilityPhotoRepository */
    private $facilityPhotoRepository;

    public function __construct(FacilityPhotoRepository $facilityPhotoRepo)
    {
        $this->facilityPhotoRepository = $facilityPhotoRepo;
    }

    /**
     * Display a listing of the FacilityPhoto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $facilityPhotosQuery = FacilityPhoto::query();

        if (request()->filled('facility_id')) {
            $facilityPhotosQuery->where('facility_id', request('facility_id'));
        }

        $facilities = Facility::all();

        $facilityPhotos = $facilityPhotosQuery->latest()->paginate(10);

        return view('adminPanel.facility_photos.index', compact('facilityPhotos', 'facilities'));
    }

    /**
     * Show the form for creating a new FacilityPhoto.
     *
     * @return Response
     */
    public function create()
    {
        $facility = Facility::get()->pluck('name', 'id');

        return view('adminPanel.facility_photos.create', compact('facility'));
    }

    /**
     * Store a newly created FacilityPhoto in storage.
     *
     * @param CreateFacilityPhotoRequest $request
     *
     * @return Response
     */
    public function store(CreateFacilityPhotoRequest $request)
    {
        $input = $request->all();

        $facilityPhoto = $this->facilityPhotoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/facilityPhotos.singular')]));

        return redirect(route('adminPanel.facilityPhotos.index'));
    }

    /**
     * Display the specified FacilityPhoto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $facilityPhoto = $this->facilityPhotoRepository->find($id);

        if (empty($facilityPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/facilityPhotos.singular')]));

            return redirect(route('adminPanel.facilityPhotos.index'));
        }

        return view('adminPanel.facility_photos.show')->with('facilityPhoto', $facilityPhoto);
    }

    /**
     * Show the form for editing the specified FacilityPhoto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $facilityPhoto = $this->facilityPhotoRepository->find($id);

        if (empty($facilityPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/facilityPhotos.singular')]));

            return redirect(route('adminPanel.facilityPhotos.index'));
        }

        $facility = Facility::get()->pluck('name', 'id');

        return view('adminPanel.facility_photos.edit', compact('facilityPhoto', 'facility'));
    }

    /**
     * Update the specified FacilityPhoto in storage.
     *
     * @param int $id
     * @param UpdateFacilityPhotoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacilityPhotoRequest $request)
    {
        $facilityPhoto = $this->facilityPhotoRepository->find($id);

        if (empty($facilityPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/facilityPhotos.singular')]));

            return redirect(route('adminPanel.facilityPhotos.index'));
        }

        $facilityPhoto = $this->facilityPhotoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/facilityPhotos.singular')]));

        return redirect(route('adminPanel.facilityPhotos.index'));
    }

    /**
     * Remove the specified FacilityPhoto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $facilityPhoto = $this->facilityPhotoRepository->find($id);

        if (empty($facilityPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/facilityPhotos.singular')]));

            return redirect(route('adminPanel.facilityPhotos.index'));
        }

        $this->facilityPhotoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/facilityPhotos.singular')]));

        return redirect(route('adminPanel.facilityPhotos.index'));
    }
}
