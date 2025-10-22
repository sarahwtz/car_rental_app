<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brand;

    public function __construct(Brand $brand){
        $this->brand = $brand;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brand->with('carModels')->get();
        return response()->json($brands, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate($this->brand->rules(), $this->brand->feedback());

        $image = $request->file('image');
        $image_urn =  $image->store('images', 'public');

    
       $brand = $this->brand->create([
        'name' => $request->name,
        'image' => $image_urn,
         ]);

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = $this->brand->with('carModels')->find($id);
        if($brand === null){
            return response()->json(['error' => 'The searched item does not exist'], 404);
        }
        return response()->json($brand,200);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
       //$brand->update($request->all());
       $brand = $this->brand->find($id);


          if($brand === null){
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

        if ($request->method() === 'PATCH') {

            $dynamicRules = array();


            foreach($brand->rules() as $input => $rule)  {
              
              
                if(array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }
       

            $request->validate($dynamicRules, $brand->feedback()); 

        } else {
            $request->validate($brand->rules($id), $brand->feedback()); 

        }

       
        if($request->file('image')) {
            Storage::disk('public')->delete($brand->image);
        }

        $image = $request->file('image');
        $image_urn =  $image->store('images', 'public');

    
       $brand->update([
        'name' => $request->name,
        'image' => $image_urn,
         ]);
       return response()->json($brand, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $brand = $this->brand->find($id); 

         if($brand === null){
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

        
            Storage::disk('public')->delete($brand->image);
        

       $brand->delete();
       return response()->json(['message' => 'The brand was deleted successfully!'], 200);
    }
}
