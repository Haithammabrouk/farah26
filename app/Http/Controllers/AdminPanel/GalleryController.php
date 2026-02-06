<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateGalleryRequest;
use App\Http\Requests\AdminPanel\UpdateGalleryRequest;
use App\Repositories\AdminPanel\GalleryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class GalleryController extends AppBaseController
{
    /** @var  GalleryRepository */
    private $galleryRepository;

    public function __construct(GalleryRepository $galleryRepo)
    {
        $this->galleryRepository = $galleryRepo;
    }

    /**
     * Display a listing of the Gallery.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $galleries = $this->galleryRepository->paginate(10);

        return view('adminPanel.galleries.index')
            ->with('galleries', $galleries);
    }

    /**
     * Show the form for creating a new Gallery.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.galleries.create');
    }

    /**
     * Store a newly created Gallery in storage.
     *
     * @param CreateGalleryRequest $request
     *
     * @return Response
     */
    public function store(CreateGalleryRequest $request)
    {
        $input = $request->all();

        $gallery = $this->galleryRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/galleries.singular')]));

        return redirect(route('adminPanel.galleries.index'));
    }

    /**
     * Display the specified Gallery.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gallery = $this->galleryRepository->find($id);

        if (empty($gallery)) {
            Flash::error(__('messages.not_found', ['model' => __('models/galleries.singular')]));

            return redirect(route('adminPanel.galleries.index'));
        }

        return view('adminPanel.galleries.show')->with('gallery', $gallery);
    }

    /**
     * Show the form for editing the specified Gallery.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gallery = $this->galleryRepository->find($id);

        if (empty($gallery)) {
            Flash::error(__('messages.not_found', ['model' => __('models/galleries.singular')]));

            return redirect(route('adminPanel.galleries.index'));
        }

        return view('adminPanel.galleries.edit')->with('gallery', $gallery);
    }

    /**
     * Update the specified Gallery in storage.
     *
     * @param int $id
     * @param UpdateGalleryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGalleryRequest $request)
    {
        $gallery = $this->galleryRepository->find($id);

        if (empty($gallery)) {
            Flash::error(__('messages.not_found', ['model' => __('models/galleries.singular')]));

            return redirect(route('adminPanel.galleries.index'));
        }

        $gallery = $this->galleryRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/galleries.singular')]));

        return redirect(route('adminPanel.galleries.index'));
    }

    /**
     * Remove the specified Gallery from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gallery = $this->galleryRepository->find($id);

        if (empty($gallery)) {
            Flash::error(__('messages.not_found', ['model' => __('models/galleries.singular')]));

            return redirect(route('adminPanel.galleries.index'));
        }

        $this->galleryRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/galleries.singular')]));

        return redirect(route('adminPanel.galleries.index'));
    }
}
