<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateTripadvisorRequest;
use App\Http\Requests\AdminPanel\UpdateTripadvisorRequest;
use App\Repositories\AdminPanel\TripadvisorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TripadvisorController extends AppBaseController
{
    /** @var  TripadvisorRepository */
    private $tripadvisorRepository;

    public function __construct(TripadvisorRepository $tripadvisorRepo)
    {
        $this->tripadvisorRepository = $tripadvisorRepo;
    }

    /**
     * Display a listing of the Tripadvisor.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tripadvisors = $this->tripadvisorRepository->paginate(10);

        return view('adminPanel.tripadvisors.index')
            ->with('tripadvisors', $tripadvisors);
    }

    /**
     * Show the form for creating a new Tripadvisor.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.tripadvisors.create');
    }

    /**
     * Store a newly created Tripadvisor in storage.
     *
     * @param CreateTripadvisorRequest $request
     *
     * @return Response
     */
    public function store(CreateTripadvisorRequest $request)
    {
        $input = $request->all();

        $tripadvisor = $this->tripadvisorRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tripadvisors.singular')]));

        return redirect(route('adminPanel.tripadvisors.index'));
    }

    /**
     * Display the specified Tripadvisor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tripadvisor = $this->tripadvisorRepository->find($id);

        if (empty($tripadvisor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripadvisors.singular')]));

            return redirect(route('adminPanel.tripadvisors.index'));
        }

        return view('adminPanel.tripadvisors.show')->with('tripadvisor', $tripadvisor);
    }

    /**
     * Show the form for editing the specified Tripadvisor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tripadvisor = $this->tripadvisorRepository->find($id);

        if (empty($tripadvisor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripadvisors.singular')]));

            return redirect(route('adminPanel.tripadvisors.index'));
        }

        return view('adminPanel.tripadvisors.edit')->with('tripadvisor', $tripadvisor);
    }

    /**
     * Update the specified Tripadvisor in storage.
     *
     * @param int $id
     * @param UpdateTripadvisorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTripadvisorRequest $request)
    {
        $tripadvisor = $this->tripadvisorRepository->find($id);

        if (empty($tripadvisor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripadvisors.singular')]));

            return redirect(route('adminPanel.tripadvisors.index'));
        }

        $tripadvisor = $this->tripadvisorRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/tripadvisors.singular')]));

        return redirect(route('adminPanel.tripadvisors.index'));
    }

    /**
     * Remove the specified Tripadvisor from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tripadvisor = $this->tripadvisorRepository->find($id);

        if (empty($tripadvisor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripadvisors.singular')]));

            return redirect(route('adminPanel.tripadvisors.index'));
        }

        $this->tripadvisorRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tripadvisors.singular')]));

        return redirect(route('adminPanel.tripadvisors.index'));
    }
}
