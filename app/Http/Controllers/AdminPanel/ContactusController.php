<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateContactusRequest;
use App\Http\Requests\AdminPanel\UpdateContactusRequest;
use App\Repositories\AdminPanel\ContactusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ContactusController extends AppBaseController
{
    /** @var  ContactusRepository */
    private $contactusRepository;

    public function __construct(ContactusRepository $contactusRepo)
    {
        $this->contactusRepository = $contactusRepo;
    }

    /**
     * Display a listing of the Contactus.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contactuses = $this->contactusRepository->paginate(10);

        return view('adminPanel.contactuses.index')
            ->with('contactuses', $contactuses);
    }

    /**
     * Show the form for creating a new Contactus.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.contactuses.create');
    }

    /**
     * Store a newly created Contactus in storage.
     *
     * @param CreateContactusRequest $request
     *
     * @return Response
     */
    public function store(CreateContactusRequest $request)
    {
        $input = $request->all();

        $contactus = $this->contactusRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/contactuses.singular')]));

        return redirect(route('adminPanel.contactuses.index'));
    }

    /**
     * Display the specified Contactus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contactus = $this->contactusRepository->find($id);

        if (empty($contactus)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contactuses.singular')]));

            return redirect(route('adminPanel.contactuses.index'));
        }

        return view('adminPanel.contactuses.show')->with('contactus', $contactus);
    }

    /**
     * Show the form for editing the specified Contactus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contactus = $this->contactusRepository->find($id);

        if (empty($contactus)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contactuses.singular')]));

            return redirect(route('adminPanel.contactuses.index'));
        }

        return view('adminPanel.contactuses.edit')->with('contactus', $contactus);
    }

    /**
     * Update the specified Contactus in storage.
     *
     * @param int $id
     * @param UpdateContactusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactusRequest $request)
    {
        $contactus = $this->contactusRepository->find($id);

        if (empty($contactus)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contactuses.singular')]));

            return redirect(route('adminPanel.contactuses.index'));
        }

        $contactus = $this->contactusRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/contactuses.singular')]));

        return redirect(route('adminPanel.contactuses.index'));
    }

    /**
     * Remove the specified Contactus from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contactus = $this->contactusRepository->find($id);

        if (empty($contactus)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contactuses.singular')]));

            return redirect(route('adminPanel.contactuses.index'));
        }

        $this->contactusRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/contactuses.singular')]));

        return redirect(route('adminPanel.contactuses.index'));
    }
}
