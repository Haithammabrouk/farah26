<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateItineraryDetailRequest;
use App\Http\Requests\AdminPanel\UpdateItineraryDetailRequest;
use App\Repositories\AdminPanel\ItineraryDetailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\ItineraryDetail;
use App\Models\Itinerary;

class ItineraryDetailController extends AppBaseController
{
    /** @var  ItineraryDetailRepository */
    private $itineraryDetailRepository;

    public function __construct(ItineraryDetailRepository $itineraryDetailRepo)
    {
        $this->itineraryDetailRepository = $itineraryDetailRepo;
    }

    /**
     * Display a listing of the ItineraryDetail.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $itineraryDetailsQuery = ItineraryDetail::with('itinerary.tripCategory');
        $itineraries = Itinerary::with('tripCategory')->get();

        if (request()->filled('itinerary_id')) {
            $itineraryDetailsQuery->where('itinerary_id', request('itinerary_id'));
        }

        $itineraryDetails = $itineraryDetailsQuery->latest()->paginate(10);

        return view('adminPanel.itinerary_details.index', compact('itineraryDetails', 'itineraries'));
    }

    /**
     * Show the form for creating a new ItineraryDetail.
     *
     * @return Response
     */
    public function create()
    {
        $itineraries = Itinerary::with('tripCategory')->get();

        return view('adminPanel.itinerary_details.create', compact('itineraries'));
    }

    /**
     * Store a newly created ItineraryDetail in storage.
     *
     * @param CreateItineraryDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateItineraryDetailRequest $request)
    {
        $input = $request->all();

        $itineraryDetail = $this->itineraryDetailRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/itineraryDetails.singular')]));

        return redirect(route('adminPanel.itineraryDetails.index'));
    }

    /**
     * Display the specified ItineraryDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $itineraryDetail = $this->itineraryDetailRepository->find($id);

        if (empty($itineraryDetail)) {
            Flash::error(__('messages.not_found', ['model' => __('models/itineraryDetails.singular')]));

            return redirect(route('adminPanel.itineraryDetails.index'));
        }

        return view('adminPanel.itinerary_details.show')->with('itineraryDetail', $itineraryDetail);
    }

    /**
     * Show the form for editing the specified ItineraryDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $itineraryDetail = $this->itineraryDetailRepository->find($id);

        if (empty($itineraryDetail)) {
            Flash::error(__('messages.not_found', ['model' => __('models/itineraryDetails.singular')]));

            return redirect(route('adminPanel.itineraryDetails.index'));
        }

        $itineraries = Itinerary::with('tripCategory')->get();

        return view('adminPanel.itinerary_details.edit', compact('itineraryDetail', 'itineraries'));
    }

    /**
     * Update the specified ItineraryDetail in storage.
     *
     * @param int $id
     * @param UpdateItineraryDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItineraryDetailRequest $request)
    {
        $itineraryDetail = $this->itineraryDetailRepository->find($id);

        if (empty($itineraryDetail)) {
            Flash::error(__('messages.not_found', ['model' => __('models/itineraryDetails.singular')]));

            return redirect(route('adminPanel.itineraryDetails.index'));
        }

        $itineraryDetail = $this->itineraryDetailRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/itineraryDetails.singular')]));

        return redirect(route('adminPanel.itineraryDetails.index'));
    }

    /**
     * Remove the specified ItineraryDetail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $itineraryDetail = $this->itineraryDetailRepository->find($id);

        if (empty($itineraryDetail)) {
            Flash::error(__('messages.not_found', ['model' => __('models/itineraryDetails.singular')]));

            return redirect(route('adminPanel.itineraryDetails.index'));
        }

        $this->itineraryDetailRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/itineraryDetails.singular')]));

        return redirect(route('adminPanel.itineraryDetails.index'));
    }
}
