<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Repositories\RentalRepository;

class RentalController extends Controller
{
    protected $rental;

    public function __construct(Rental $rental)
    {
        $this->rental = $rental;
    }

    /**
     */
    public function index(Request $request)
    {
        $rentalRepository = new RentalRepository($this->rental);

        if ($request->has('filter')) {
            $rentalRepository->filter($request->filter);
        }

        if ($request->has('fields')) {
            $rentalRepository->selectFields($request->fields);
        }

        return response()->json($rentalRepository->getResult(), 200);
    }

    /**
     */
    public function store(StoreRentalRequest $request)
    {
        $rental = $this->rental->create($request->validated());

        return response()->json($rental, 201);
    }

    /**
     */
    public function show($id)
    {
        $rental = $this->rental->with(['client', 'car'])->find($id);

        if (!$rental) {
            return response()->json(['error' => 'The searched item does not exist'], 404);
        }

        return response()->json($rental, 200);
    }

    /**
     */
    public function update(UpdateRentalRequest $request, $id)
    {
        $rental = $this->rental->find($id);

        if (!$rental) {
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

        $rental->update($request->validated());

        return response()->json($rental, 200);
    }

    /**
     */
    public function destroy($id)
    {
        $rental = $this->rental->find($id);

        if (!$rental) {
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

        $rental->delete();

        return response()->json(['message' => 'The rental was deleted successfully!'], 200);
    }
}
