<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateUniqueRequest;
use App\Http\Requests\AdminPanel\UpdateUniqueRequest;
use App\Repositories\AdminPanel\UniqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class UniqueController extends AppBaseController
{
    /** @var  UniqueRepository */
    private $uniqueRepository;

    public function __construct(UniqueRepository $uniqueRepo)
    {
        $this->uniqueRepository = $uniqueRepo;
    }

    /**
     * Display a listing of the Unique.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $uniques = $this->uniqueRepository->paginate(10);

        return view('adminPanel.uniques.index')
            ->with('uniques', $uniques);
    }

    /**
     * Show the form for creating a new Unique.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.uniques.create');
    }

    /**
     * Store a newly created Unique in storage.
     *
     * @param CreateUniqueRequest $request
     *
     * @return Response
     */
    public function store(CreateUniqueRequest $request)
    {
        $input = $request->all();

        $unique = $this->uniqueRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/uniques.singular')]));

        return redirect(route('adminPanel.uniques.index'));
    }

    /**
     * Display the specified Unique.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $unique = $this->uniqueRepository->find($id);

        if (empty($unique)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uniques.singular')]));

            return redirect(route('adminPanel.uniques.index'));
        }

        return view('adminPanel.uniques.show')->with('unique', $unique);
    }

    /**
     * Show the form for editing the specified Unique.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unique = $this->uniqueRepository->find($id);

        if (empty($unique)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uniques.singular')]));

            return redirect(route('adminPanel.uniques.index'));
        }

        return view('adminPanel.uniques.edit')->with('unique', $unique);
    }

    /**
     * Update the specified Unique in storage.
     *
     * @param int $id
     * @param UpdateUniqueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUniqueRequest $request)
    {
        $unique = $this->uniqueRepository->find($id);

        if (empty($unique)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uniques.singular')]));

            return redirect(route('adminPanel.uniques.index'));
        }

        $unique = $this->uniqueRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/uniques.singular')]));

        return redirect(route('adminPanel.uniques.index'));
    }

    /**
     * Remove the specified Unique from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $unique = $this->uniqueRepository->find($id);

        if (empty($unique)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uniques.singular')]));

            return redirect(route('adminPanel.uniques.index'));
        }

        $this->uniqueRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/uniques.singular')]));

        return redirect(route('adminPanel.uniques.index'));
    }
}
