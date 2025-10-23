<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    protected $carModel;

    public function __construct(CarModel $carModel){
        $this->carModel = $carModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
{
    $carModels = $this->carModel->query();

   
    if ($request->has('fields_brand')) {
        $fields_brand = $request->query('fields_brand');
        $carModels = $carModels->with('brand:id,' . $fields_brand);
    } else {
        $carModels = $carModels->with('brand');
    }

    if($request->has('filter')) {
        $filters = explode(';',$request->filter);
        foreach($filters as $key => $condition) {

            $c = explode(':', $condition);
            $carModels = $carModels->where($c[0], $c[1], $c[2]);

        }

 
        
    }


    if ($request->has('fields')) {
        $fields = explode(',', $request->query('fields'));
        $carModels = $carModels->select($fields);
    }

  
    $carModels = $carModels->get();

    return response()->json($carModels, 200);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->carModel->rules(), $this->carModel->feedback());

        $image = $request->file('image');
        $image_urn =  $image->store('images/carModels', 'public');

    
       $carModel = $this->carModel->create([
       'brand_id' => $request->brand_id,
        'name' => $request->name,
        'image' => $image_urn,
        'doors_count' => $request->doors_count,
        'seats' => $request->seats,
        'air_bag' => $request->air_bag,
        'abs' => $request->abs,
         ]);

        return response()->json($carModel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carModel = $this->carModel->with('brand')->find($id);
        if($carModel === null){
            return response()->json(['error' => 'The searched item does not exist'], 404);
        }
        return response()->json($carModel,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CarModel $carModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           $carModel = $this->carModel->find($id);

          if($carModel === null){
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

        if ($request->method() === 'PATCH') {

            $dynamicRules = array();


            foreach($carModel->rules() as $input => $rule)  {
              
              
                if(array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }
       

            $request->validate($dynamicRules,$carModel->feedback()); 

        } else {
            $request->validate($carModel->rules(), $carModel->feedback()); 

        }

    
        if($request->file('image')) {
            Storage::disk('public')->delete($carModel->image);
        }

        $image = $request->file('image');
        $image_urn =  $image->store('images/carModels', 'public');

        $carModel->fill($request->all());
        $carModel->image = $image_urn;
        $carModel->save();

        /*
      $carModel->update([
        'brand_id' => $request->brand_id,
        'name' => $request->name,
        'image' => $image_urn,
        'doors_count' => $request->doors_count,
        'seats' => $request->seats,
        'air_bag' => $request->air_bag,
        'abs' => $request->abs,
         ]);
         */
       return response()->json($carModel, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $carModel = $this->carModel->find($id); 

         if($carModel === null){
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

        // Remove the old file 
            Storage::disk('public')->delete($carModel->image);
        

      $carModel->delete();
       return response()->json(['message' => 'The car model was deleted successfully!'], 200);
 
   
    }
}
