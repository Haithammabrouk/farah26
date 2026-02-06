<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateClosedDatesRequest;
use App\Http\Requests\AdminPanel\UpdateClosedDatesRequest;
use App\Repositories\AdminPanel\ClosedDatesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ClosedDatesController extends AppBaseController
{
    /** @var  ClosedDatesRepository */
    private $closedDatesRepository;

    public function __construct(ClosedDatesRepository $closedDatesRepo)
    {
        $this->closedDatesRepository = $closedDatesRepo;
    }

    /**
     * Display a listing of the ClosedDates.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $closedDates = $this->closedDatesRepository->paginate(10);

        return view('adminPanel.closed_dates.index')
            ->with('closedDates', $closedDates);
    }

    /**
     * Show the form for creating a new ClosedDates.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.closed_dates.create');
    }

    /**
     * Store a newly created ClosedDates in storage.
     *
     * @param CreateClosedDatesRequest $request
     *
     * @return Response
     */
    public function store(CreateClosedDatesRequest $request)
    {
        $input = $request->all();

        $closedDates = $this->closedDatesRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/closedDates.singular')]));

        return redirect(route('adminPanel.closedDates.index'));
    }

    /**
     * Display the specified ClosedDates.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $closedDates = $this->closedDatesRepository->find($id);

        if (empty($closedDates)) {
            Flash::error(__('messages.not_found', ['model' => __('models/closedDates.singular')]));

            return redirect(route('adminPanel.closedDates.index'));
        }

        return view('adminPanel.closed_dates.show')->with('closedDates', $closedDates);
    }

    /**
     * Show the form for editing the specified ClosedDates.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $closedDates = $this->closedDatesRepository->find($id);

        if (empty($closedDates)) {
            Flash::error(__('messages.not_found', ['model' => __('models/closedDates.singular')]));

            return redirect(route('adminPanel.closedDates.index'));
        }

        return view('adminPanel.closed_dates.edit')->with('closedDates', $closedDates);
    }

    /**
     * Update the specified ClosedDates in storage.
     *
     * @param int $id
     * @param UpdateClosedDatesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClosedDatesRequest $request)
    {
        $closedDates = $this->closedDatesRepository->find($id);

        if (empty($closedDates)) {
            Flash::error(__('messages.not_found', ['model' => __('models/closedDates.singular')]));

            return redirect(route('adminPanel.closedDates.index'));
        }

        $closedDates = $this->closedDatesRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/closedDates.singular')]));

        return redirect(route('adminPanel.closedDates.index'));
    }

    /**
     * Remove the specified ClosedDates from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $closedDates = $this->closedDatesRepository->find($id);

        if (empty($closedDates)) {
            Flash::error(__('messages.not_found', ['model' => __('models/closedDates.singular')]));

            return redirect(route('adminPanel.closedDates.index'));
        }

        $this->closedDatesRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/closedDates.singular')]));

        return redirect(route('adminPanel.closedDates.index'));
    }
}
