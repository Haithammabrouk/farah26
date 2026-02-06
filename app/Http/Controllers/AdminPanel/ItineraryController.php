<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateItineraryRequest;
use App\Http\Requests\AdminPanel\UpdateItineraryRequest;
use App\Repositories\AdminPanel\ItineraryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\TripCategory;

class ItineraryController extends AppBaseController
{
    /** @var  ItineraryRepository */
    private $itinerariesRepository;

    public function __construct(ItineraryRepository $itinerariesRepo)
    {
        $this->itinerariesRepository = $itinerariesRepo;
    }

    /**
     * Display a listing of the Itinerary.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $itineraries = $this->itinerariesRepository->paginate(10);

        return view('adminPanel.itineraries.index')
            ->with('itineraries', $itineraries);
    }

    /**
     * Show the form for creating a new Itinerary.
     *
     * @return Response
     */
    public function create()
    {
        $tripCategories = TripCategory::get()->pluck('name', 'id');

        return view('adminPanel.itineraries.create', compact('tripCategories'));
    }

    /**
     * Store a newly created Itinerary in storage.
     *
     * @param CreateItineraryRequest $request
     *
     * @return Response
     */
    public function store(CreateItineraryRequest $request)
    {
        $input = $request->all();

        $itineraries = $this->itinerariesRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/itineraries.singular')]));

        return redirect(route('adminPanel.itineraries.index'));
    }

    /**
     * Display the specified Itinerary.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $itineraries = $this->itinerariesRepository->find($id);

        if (empty($itineraries)) {
            Flash::error(__('messages.not_found', ['model' => __('models/itineraries.singular')]));

            return redirect(route('adminPanel.itineraries.index'));
        }

        return view('adminPanel.itineraries.show')->with('itineraries', $itineraries);
    }

    /**
     * Show the form for editing the specified Itinerary.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $itineraries = $this->itinerariesRepository->find($id);

        if (empty($itineraries)) {
            Flash::error(__('messages.not_found', ['model' => __('models/itineraries.singular')]));

            return redirect(route('adminPanel.itineraries.index'));
        }
        
        $tripCategories = TripCategory::get()->pluck('name', 'id');

        return view('adminPanel.itineraries.edit', compact('itineraries', 'tripCategories'));
    }

    /**
     * Update the specified Itinerary in storage.
     *
     * @param int $id
     * @param UpdateItineraryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItineraryRequest $request)
    {
        $itineraries = $this->itinerariesRepository->find($id);

        if (empty($itineraries)) {
            Flash::error(__('messages.not_found', ['model' => __('models/itineraries.singular')]));

            return redirect(route('adminPanel.itineraries.index'));
        }

        $itineraries = $this->itinerariesRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/itineraries.singular')]));

        return redirect(route('adminPanel.itineraries.index'));
    }

    /**
     * Remove the specified Itinerary from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $itineraries = $this->itinerariesRepository->find($id);

        if (empty($itineraries)) {
            Flash::error(__('messages.not_found', ['model' => __('models/itineraries.singular')]));

            return redirect(route('adminPanel.itineraries.index'));
        }

        $this->itinerariesRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/itineraries.singular')]));

        return redirect(route('adminPanel.itineraries.index'));
    }
}
