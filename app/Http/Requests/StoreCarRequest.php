<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
{
    return [
        'model_id' => 'required|integer|exists:car_models,id',
        'license_plate' => 'required|string|max:20|unique:cars,license_plate',
        'available' => 'required|boolean',
        'km' => 'required|numeric|min:0',
    ];
}

}
