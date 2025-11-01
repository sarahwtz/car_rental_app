<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarModelRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
    
        $id = $this->route('car_model'); 

        return [
            'brand_id'    => 'sometimes|exists:brands,id',
            'name'        => 'sometimes|min:3|unique:car_models,name,' . $id,
            'image'       => 'sometimes|file|mimes:png,jpeg,jpg',
            'doors_count' => 'sometimes|integer|min:1|max:5',
            'seats'       => 'sometimes|integer|min:1|max:20',
            'air_bag'     => 'sometimes|boolean',
            'abs'         => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'This CarModel name already exists',
            'name.min' => 'The name must be at least 3 characters long',
            'brand_id.exists' => 'The selected brand does not exist',
            'image.file' => 'The uploaded file must be a valid file',
            'image.mimes' => 'The image must be a file of type: png, jpeg, jpg',
            'doors_count.integer' => 'Doors count must be an integer',
            'doors_count.min' => 'Doors count must be at least 1',
            'doors_count.max' => 'Doors count cannot be greater than 5',
            'seats.integer' => 'Seats must be an integer',
            'seats.min' => 'Seats must be at least 1',
            'seats.max' => 'Seats cannot be greater than 20',
            'air_bag.boolean' => 'Air bag must be true or false',
            'abs.boolean' => 'ABS must be true or false',
        ];
    }
}
