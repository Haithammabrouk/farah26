<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateDeckRequest;
use App\Http\Requests\AdminPanel\UpdateDeckRequest;
use App\Repositories\AdminPanel\DeckRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DeckController extends AppBaseController
{
    /** @var  DeckRepository */
    private $deckRepository;

    public function __construct(DeckRepository $deckRepo)
    {
        $this->deckRepository = $deckRepo;
    }

    /**
     * Display a listing of the Deck.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $decks = $this->deckRepository->paginate(10);

        return view('adminPanel.decks.index')
            ->with('decks', $decks);
    }

    /**
     * Show the form for creating a new Deck.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.decks.create');
    }

    /**
     * Store a newly created Deck in storage.
     *
     * @param CreateDeckRequest $request
     *
     * @return Response
     */
    public function store(CreateDeckRequest $request)
    {
        $input = $request->all();

        $deck = $this->deckRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/decks.singular')]));

        return redirect(route('adminPanel.decks.index'));
    }

    /**
     * Display the specified Deck.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deck = $this->deckRepository->find($id);

        if (empty($deck)) {
            Flash::error(__('messages.not_found', ['model' => __('models/decks.singular')]));

            return redirect(route('adminPanel.decks.index'));
        }

        return view('adminPanel.decks.show')->with('deck', $deck);
    }

    /**
     * Show the form for editing the specified Deck.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deck = $this->deckRepository->find($id);

        if (empty($deck)) {
            Flash::error(__('messages.not_found', ['model' => __('models/decks.singular')]));

            return redirect(route('adminPanel.decks.index'));
        }

        return view('adminPanel.decks.edit')->with('deck', $deck);
    }

    /**
     * Update the specified Deck in storage.
     *
     * @param int $id
     * @param UpdateDeckRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeckRequest $request)
    {
        $deck = $this->deckRepository->find($id);

        if (empty($deck)) {
            Flash::error(__('messages.not_found', ['model' => __('models/decks.singular')]));

            return redirect(route('adminPanel.decks.index'));
        }

        $deck = $this->deckRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/decks.singular')]));

        return redirect(route('adminPanel.decks.index'));
    }

    /**
     * Remove the specified Deck from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deck = $this->deckRepository->find($id);

        if (empty($deck)) {
            Flash::error(__('messages.not_found', ['model' => __('models/decks.singular')]));

            return redirect(route('adminPanel.decks.index'));
        }

        $this->deckRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/decks.singular')]));

        return redirect(route('adminPanel.decks.index'));
    }
}
