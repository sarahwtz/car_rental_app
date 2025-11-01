<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Repositories\CarRepository;


class CarController extends Controller
{
    protected $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function index(Request $request)
    {
        $carRepository = new CarRepository($this->car);

        if ($request->has('fields_carModel')) {
            $fields_carModels = 'carModel:id,' . $request->query('fields_carModel');
            $carRepository->selectRelatedFields($fields_carModels);
        } else {
            $carRepository->selectRelatedFields('carModel');
        }

        if ($request->has('filter')) {
            $carRepository->filter($request->filter);
        }

        if ($request->has('fields')) {
            $carRepository->selectFields($request->fields);
        }

        return response()->json($carRepository->getResult(), 200);
    }

    

   public function store(StoreCarRequest $request)
{
    $car = $this->car->create($request->validated());

    return response()->json($car, 201);
}

    

    public function show($id)
    {
        $car = $this->car->with('carModel')->find($id);

        if (!$car) {
            return response()->json(['error' => 'The searched item does not exist'], 404);
        }

        return response()->json($car, 200);
    }

    

   public function update(UpdateCarRequest $request, $id)
{
    $car = $this->car->find($id);

    if (!$car) {
        return response()->json(['error' => 'The requested item does not exist'], 404);
    }

    $car->update($request->validated());

    return response()->json($car, 200);
}


public function destroy($id)
{
    $car = $this->car->find($id);

    if (!$car) {
        return response()->json(['error' => 'The requested item does not exist'], 404);
    }

    $car->delete();

    return response()->json(['message' => 'The car was deleted successfully!'], 200);
}


}
