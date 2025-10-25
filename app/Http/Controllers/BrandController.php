<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Repositories\BrandRepository;

class BrandController extends Controller
{
    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brandRepository = new BrandRepository($this->brand);

        if ($request->has('fields_carModels')) {
            $fields_carModels = 'carModels:id,' . $request->query('fields_carModels');
            $brandRepository->selectRelatedFields($fields_carModels);
        } else {
            $brandRepository->selectRelatedFields('carModels');
        }

        if ($request->has('filter')) {
            $brandRepository->filter($request->filter);
        }

        if ($request->has('fields')) {
            $brandRepository->selectFields($request->fields);
        }

     
        return response()->json($brandRepository->getResult(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->brand->rules(), $this->brand->feedback());

        $image = $request->file('image');
        $image_urn = $image->store('images', 'public');

        $brand = $this->brand->create([
            'name' => $request->name,
            'image' => $image_urn,
        ]);

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = $this->brand->with('carModels')->find($id);

        if ($brand === null) {
            return response()->json(['error' => 'The searched item does not exist'], 404);
        }

        return response()->json($brand, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $brand = $this->brand->find($id);

        if ($brand === null) {
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

        if ($request->method() === 'PATCH') {
            $dynamicRules = [];

            foreach ($brand->rules() as $input => $rule) {
                if (array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }

            $request->validate($dynamicRules, $brand->feedback());
        } else {
            $request->validate($brand->rules($id), $brand->feedback());
        }

        if ($request->file('image')) {
            Storage::disk('public')->delete($brand->image);
            $image = $request->file('image');
            $image_urn = $image->store('images', 'public');
            $brand->image = $image_urn;
        }

        $brand->fill($request->all());
        $brand->save();

        return response()->json($brand, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = $this->brand->find($id);

        if ($brand === null) {
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

        Storage::disk('public')->delete($brand->image);
        $brand->delete();

        return response()->json(['message' => 'The brand was deleted successfully!'], 200);
    }
}
