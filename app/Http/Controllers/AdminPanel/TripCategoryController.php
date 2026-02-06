<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateTripCategoryRequest;
use App\Http\Requests\AdminPanel\UpdateTripCategoryRequest;
use App\Repositories\AdminPanel\TripCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TripCategoryController extends AppBaseController
{
    /** @var  TripCategoryRepository */
    private $tripCategoryRepository;

    public function __construct(TripCategoryRepository $tripCategoryRepo)
    {
        $this->tripCategoryRepository = $tripCategoryRepo;
    }

    /**
     * Display a listing of the TripCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tripCategories = $this->tripCategoryRepository->paginate(10);

        return view('adminPanel.trip_categories.index')
            ->with('tripCategories', $tripCategories);
    }

    /**
     * Show the form for creating a new TripCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.trip_categories.create');
    }

    /**
     * Store a newly created TripCategory in storage.
     *
     * @param CreateTripCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateTripCategoryRequest $request)
    {
        $input = $request->all();

        $tripCategory = $this->tripCategoryRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tripCategories.singular')]));

        return redirect(route('adminPanel.tripCategories.index'));
    }

    /**
     * Display the specified TripCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tripCategory = $this->tripCategoryRepository->find($id);

        if (empty($tripCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripCategories.singular')]));

            return redirect(route('adminPanel.tripCategories.index'));
        }

        return view('adminPanel.trip_categories.show')->with('tripCategory', $tripCategory);
    }

    /**
     * Show the form for editing the specified TripCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tripCategory = $this->tripCategoryRepository->find($id);

        if (empty($tripCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripCategories.singular')]));

            return redirect(route('adminPanel.tripCategories.index'));
        }

        return view('adminPanel.trip_categories.edit')->with('tripCategory', $tripCategory);
    }

    /**
     * Update the specified TripCategory in storage.
     *
     * @param int $id
     * @param UpdateTripCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTripCategoryRequest $request)
    {
        $tripCategory = $this->tripCategoryRepository->find($id);

        if (empty($tripCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripCategories.singular')]));

            return redirect(route('adminPanel.tripCategories.index'));
        }

        $tripCategory = $this->tripCategoryRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/tripCategories.singular')]));

        return redirect(route('adminPanel.tripCategories.index'));
    }

    /**
     * Remove the specified TripCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tripCategory = $this->tripCategoryRepository->find($id);

        if (empty($tripCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripCategories.singular')]));

            return redirect(route('adminPanel.tripCategories.index'));
        }

        $this->tripCategoryRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tripCategories.singular')]));

        return redirect(route('adminPanel.tripCategories.index'));
    }
}
