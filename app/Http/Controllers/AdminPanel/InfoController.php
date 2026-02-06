<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateInfoRequest;
use App\Http\Requests\AdminPanel\UpdateInfoRequest;
use App\Repositories\AdminPanel\InfoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class InfoController extends AppBaseController
{
    /** @var  InfoRepository */
    private $infoRepository;

    public function __construct(InfoRepository $infoRepo)
    {
        $this->infoRepository = $infoRepo;
    }

    /**
     * Display a listing of the Info.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $infos = $this->infoRepository->paginate(10);

        return view('adminPanel.infos.index')
            ->with('infos', $infos);
    }

    /**
     * Show the form for creating a new Info.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.infos.create');
    }

    /**
     * Store a newly created Info in storage.
     *
     * @param CreateInfoRequest $request
     *
     * @return Response
     */
    public function store(CreateInfoRequest $request)
    {
        $input = $request->all();

        $info = $this->infoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/infos.singular')]));

        return redirect(route('adminPanel.infos.index'));
    }

    /**
     * Display the specified Info.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $info = $this->infoRepository->find($id);

        if (empty($info)) {
            Flash::error(__('messages.not_found', ['model' => __('models/infos.singular')]));

            return redirect(route('adminPanel.infos.index'));
        }

        return view('adminPanel.infos.show')->with('info', $info);
    }

    /**
     * Show the form for editing the specified Info.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $info = $this->infoRepository->find($id);

        if (empty($info)) {
            Flash::error(__('messages.not_found', ['model' => __('models/infos.singular')]));

            return redirect(route('adminPanel.infos.index'));
        }

        return view('adminPanel.infos.edit')->with('info', $info);
    }

    /**
     * Update the specified Info in storage.
     *
     * @param int $id
     * @param UpdateInfoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInfoRequest $request)
    {
        $info = $this->infoRepository->find($id);

        if (empty($info)) {
            Flash::error(__('messages.not_found', ['model' => __('models/infos.singular')]));

            return redirect(route('adminPanel.infos.index'));
        }

        $info = $this->infoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/infos.singular')]));

        return redirect(route('adminPanel.infos.index'));
    }

    /**
     * Remove the specified Info from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $info = $this->infoRepository->find($id);

        if (empty($info)) {
            Flash::error(__('messages.not_found', ['model' => __('models/infos.singular')]));

            return redirect(route('adminPanel.infos.index'));
        }

        $this->infoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/infos.singular')]));

        return redirect(route('adminPanel.infos.index'));
    }
}
