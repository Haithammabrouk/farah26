<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreatemetaRequest;
use App\Http\Requests\AdminPanel\UpdatemetaRequest;
use App\Repositories\AdminPanel\metaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class metaController extends AppBaseController
{
    /** @var  metaRepository */
    private $metaRepository;

    public function __construct(metaRepository $metaRepo)
    {
        $this->metaRepository = $metaRepo;
    }

    /**
     * Display a listing of the meta.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $metas = $this->metaRepository->paginate(10);

        return view('adminPanel.metas.index')
            ->with('metas', $metas);
    }

    /**
     * Show the form for creating a new meta.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.metas.create');
    }

    /**
     * Store a newly created meta in storage.
     *
     * @param CreatemetaRequest $request
     *
     * @return Response
     */
    public function store(CreatemetaRequest $request)
    {
        $input = $request->all();

        $meta = $this->metaRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/metas.singular')]));

        return redirect(route('adminPanel.metas.index'));
    }

    /**
     * Display the specified meta.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $meta = $this->metaRepository->find($id);

        if (empty($meta)) {
            Flash::error(__('messages.not_found', ['model' => __('models/metas.singular')]));

            return redirect(route('adminPanel.metas.index'));
        }

        return view('adminPanel.metas.show')->with('meta', $meta);
    }

    /**
     * Show the form for editing the specified meta.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $meta = $this->metaRepository->find($id);

        if (empty($meta)) {
            Flash::error(__('messages.not_found', ['model' => __('models/metas.singular')]));

            return redirect(route('adminPanel.metas.index'));
        }

        return view('adminPanel.metas.edit')->with('meta', $meta);
    }

    /**
     * Update the specified meta in storage.
     *
     * @param int $id
     * @param UpdatemetaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemetaRequest $request)
    {
        $meta = $this->metaRepository->find($id);

        if (empty($meta)) {
            Flash::error(__('messages.not_found', ['model' => __('models/metas.singular')]));

            return redirect(route('adminPanel.metas.index'));
        }

        $meta = $this->metaRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/metas.singular')]));

        return redirect(route('adminPanel.metas.index'));
    }

    /**
     * Remove the specified meta from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $meta = $this->metaRepository->find($id);

        if (empty($meta)) {
            Flash::error(__('messages.not_found', ['model' => __('models/metas.singular')]));

            return redirect(route('adminPanel.metas.index'));
        }

        $this->metaRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/metas.singular')]));

        return redirect(route('adminPanel.metas.index'));
    }
}
