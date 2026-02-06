<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateSliderPhotoRequest;
use App\Http\Requests\AdminPanel\UpdateSliderPhotoRequest;
use App\Repositories\AdminPanel\SliderPhotoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SliderPhotoController extends AppBaseController
{
    /** @var  SliderPhotoRepository */
    private $sliderPhotoRepository;

    public function __construct(SliderPhotoRepository $sliderPhotoRepo)
    {
        $this->sliderPhotoRepository = $sliderPhotoRepo;
    }

    /**
     * Display a listing of the SliderPhoto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sliderPhotos = $this->sliderPhotoRepository->paginate(10);

        return view('adminPanel.slider_photos.index')
            ->with('sliderPhotos', $sliderPhotos);
    }

    /**
     * Show the form for creating a new SliderPhoto.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.slider_photos.create');
    }

    /**
     * Store a newly created SliderPhoto in storage.
     *
     * @param CreateSliderPhotoRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderPhotoRequest $request)
    {
        $input = $request->all();

        $sliderPhoto = $this->sliderPhotoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/sliderPhotos.singular')]));

        return redirect(route('adminPanel.sliderPhotos.index'));
    }

    /**
     * Display the specified SliderPhoto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sliderPhoto = $this->sliderPhotoRepository->find($id);

        if (empty($sliderPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sliderPhotos.singular')]));

            return redirect(route('adminPanel.sliderPhotos.index'));
        }

        return view('adminPanel.slider_photos.show')->with('sliderPhoto', $sliderPhoto);
    }

    /**
     * Show the form for editing the specified SliderPhoto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sliderPhoto = $this->sliderPhotoRepository->find($id);

        if (empty($sliderPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sliderPhotos.singular')]));

            return redirect(route('adminPanel.sliderPhotos.index'));
        }

        return view('adminPanel.slider_photos.edit')->with('sliderPhoto', $sliderPhoto);
    }

    /**
     * Update the specified SliderPhoto in storage.
     *
     * @param int $id
     * @param UpdateSliderPhotoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSliderPhotoRequest $request)
    {
        $sliderPhoto = $this->sliderPhotoRepository->find($id);

        if (empty($sliderPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sliderPhotos.singular')]));

            return redirect(route('adminPanel.sliderPhotos.index'));
        }

        $sliderPhoto = $this->sliderPhotoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/sliderPhotos.singular')]));

        return redirect(route('adminPanel.sliderPhotos.index'));
    }

    /**
     * Remove the specified SliderPhoto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sliderPhoto = $this->sliderPhotoRepository->find($id);

        if (empty($sliderPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sliderPhotos.singular')]));

            return redirect(route('adminPanel.sliderPhotos.index'));
        }

        $this->sliderPhotoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/sliderPhotos.singular')]));

        return redirect(route('adminPanel.sliderPhotos.index'));
    }
}
