<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarModelRequest extends FormRequest
{
    public function authorize()
    {
        return true; // qualquer usuário autenticado pode criar
    }

    public function rules()
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|min:3|unique:car_models,name',
            'image' => 'required|file|mimes:png,jpeg,jpg',
            'doors_count' => 'required|integer|min:1|max:5',
            'seats' => 'required|integer|min:1|max:20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Brand ID is required',
            'brand_id.exists' => 'The selected brand does not exist',
            'name.required' => 'Name is required',
            'name.min' => 'The name must be at least 3 characters long',
            'name.unique' => 'This CarModel name already exists',
            'image.required' => 'Image is required',
            'image.file' => 'The uploaded file must be a valid file',
            'image.mimes' => 'The image must be a file of type: png, jpeg, jpg',
            'doors_count.required' => 'Doors count is required',
            'doors_count.integer' => 'Doors count must be an integer',
            'doors_count.min' => 'Doors count must be at least 1',
            'doors_count.max' => 'Doors count cannot be greater than 5',
            'seats.required' => 'Seats is required',
            'seats.integer' => 'Seats must be an integer',
            'seats.min' => 'Seats must be at least 1',
            'seats.max' => 'Seats cannot be greater than 20',
            'air_bag.required' => 'Air bag is required',
            'air_bag.boolean' => 'Air bag must be true or false',
            'abs.required' => 'ABS is required',
            'abs.boolean' => 'ABS must be true or false',
        ];
    }
}
