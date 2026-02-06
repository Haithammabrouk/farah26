<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateGalleryPhotoRequest;
use App\Http\Requests\AdminPanel\UpdateGalleryPhotoRequest;
use App\Repositories\AdminPanel\GalleryPhotoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Gallery;
use App\Models\GalleryPhoto;

class GalleryPhotoController extends AppBaseController
{
    /** @var  GalleryPhotoRepository */
    private $galleryPhotoRepository;

    public function __construct(GalleryPhotoRepository $galleryPhotoRepo)
    {
        $this->galleryPhotoRepository = $galleryPhotoRepo;
    }

    /**
     * Display a listing of the GalleryPhoto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $galleryPhotosQuery = GalleryPhoto::query();

        $galleries = Gallery::get();

        if (request()->filled('gallery_id')) {
            $galleryPhotosQuery->where('gallery_id', request('gallery_id'));
        }

        if (request()->filled('is_home')) {
            $galleryPhotosQuery->where('is_home', request('is_home'));
        }

        $galleryPhotos = $galleryPhotosQuery->latest()->paginate(10);

        return view('adminPanel.gallery_photos.index', compact("galleryPhotos", "galleries"));
    }

    /**
     * Show the form for creating a new GalleryPhoto.
     *
     * @return Response
     */
    public function create()
    {
        $galleries = Gallery::get()->pluck('name', 'id');

        return view('adminPanel.gallery_photos.create', compact("galleries"));
    }

    /**
     * Store a newly created GalleryPhoto in storage.
     *
     * @param CreateGalleryPhotoRequest $request
     *
     * @return Response
     */
    public function store(CreateGalleryPhotoRequest $request)
    {
        $input = $request->all();

        $this->galleryPhotoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/galleryPhotos.singular')]));

        return redirect(route('adminPanel.galleryPhotos.index'));
    }

    /**
     * Display the specified GalleryPhoto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $galleryPhoto = $this->galleryPhotoRepository->find($id);

        if (empty($galleryPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/galleryPhotos.singular')]));

            return redirect(route('adminPanel.galleryPhotos.index'));
        }

        return view('adminPanel.gallery_photos.show')->with('galleryPhoto', $galleryPhoto);
    }

    /**
     * Show the form for editing the specified GalleryPhoto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $galleryPhoto = $this->galleryPhotoRepository->find($id);

        if (empty($galleryPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/galleryPhotos.singular')]));

            return redirect(route('adminPanel.galleryPhotos.index'));
        }

        $galleries = Gallery::get()->pluck('name', 'id');

        return view('adminPanel.gallery_photos.edit', compact('galleryPhoto', 'galleries'));
    }

    /**
     * Update the specified GalleryPhoto in storage.
     *
     * @param int $id
     * @param UpdateGalleryPhotoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGalleryPhotoRequest $request)
    {
        $galleryPhoto = $this->galleryPhotoRepository->find($id);

        if (empty($galleryPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/galleryPhotos.singular')]));

            return redirect(route('adminPanel.galleryPhotos.index'));
        }

        $galleryPhoto = $this->galleryPhotoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/galleryPhotos.singular')]));

        return redirect(route('adminPanel.galleryPhotos.index'));
    }

    /**
     * Remove the specified GalleryPhoto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $galleryPhoto = $this->galleryPhotoRepository->find($id);

        if (empty($galleryPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/galleryPhotos.singular')]));

            return redirect(route('adminPanel.galleryPhotos.index'));
        }

        $this->galleryPhotoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/galleryPhotos.singular')]));

        return redirect(route('adminPanel.galleryPhotos.index'));
    }
}
