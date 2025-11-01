<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'model_id' => 'sometimes|required|integer|exists:car_models,id',
            'license_plate' => 'sometimes|required|string|max:20|unique:cars,license_plate,' . $this->route('id'),
            'available' => 'sometimes|required|boolean',
            'km' => 'sometimes|required|numeric|min:0',
        ];
    }
}
