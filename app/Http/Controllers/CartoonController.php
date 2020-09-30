<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCartoonRequest;
use App\Http\Requests\UpdateCartoonRequest;
use App\Repositories\CartoonRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CartoonController extends AppBaseController
{
    /** @var  CartoonRepository */
    private $cartoonRepository;

    public function __construct(CartoonRepository $cartoonRepo)
    {
        $this->cartoonRepository = $cartoonRepo;
    }

    /**
     * Display a listing of the Cartoon.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cartoons = $this->cartoonRepository->all();

        return view('cartoons.index')
            ->with('cartoons', $cartoons);
    }

    /**
     * Show the form for creating a new Cartoon.
     *
     * @return Response
     */
    public function create()
    {
        return view('cartoons.create');
    }

    /**
     * Store a newly created Cartoon in storage.
     *
     * @param CreateCartoonRequest $request
     *
     * @return Response
     */
    public function store(CreateCartoonRequest $request)
    {
        $input = $request->all();

        $cartoon = $this->cartoonRepository->create($input);

        Flash::success('Cartoon saved successfully.');

        return redirect(route('cartoons.index'));
    }

    /**
     * Display the specified Cartoon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cartoon = $this->cartoonRepository->find($id);

        if (empty($cartoon)) {
            Flash::error('Cartoon not found');

            return redirect(route('cartoons.index'));
        }

        return view('cartoons.show')->with('cartoon', $cartoon);
    }

    /**
     * Show the form for editing the specified Cartoon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cartoon = $this->cartoonRepository->find($id);

        if (empty($cartoon)) {
            Flash::error('Cartoon not found');

            return redirect(route('cartoons.index'));
        }

        return view('cartoons.edit')->with('cartoon', $cartoon);
    }

    /**
     * Update the specified Cartoon in storage.
     *
     * @param int $id
     * @param UpdateCartoonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCartoonRequest $request)
    {
        $cartoon = $this->cartoonRepository->find($id);

        if (empty($cartoon)) {
            Flash::error('Cartoon not found');

            return redirect(route('cartoons.index'));
        }

        $cartoon = $this->cartoonRepository->update($request->all(), $id);

        Flash::success('Cartoon updated successfully.');

        return redirect(route('cartoons.index'));
    }

    /**
     * Remove the specified Cartoon from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cartoon = $this->cartoonRepository->find($id);

        if (empty($cartoon)) {
            Flash::error('Cartoon not found');

            return redirect(route('cartoons.index'));
        }

        $this->cartoonRepository->delete($id);

        Flash::success('Cartoon deleted successfully.');

        return redirect(route('cartoons.index'));
    }
}
