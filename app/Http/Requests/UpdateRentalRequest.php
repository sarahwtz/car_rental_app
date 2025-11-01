<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRentalRequest extends FormRequest
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
        'client_id' => 'sometimes|exists:clients,id',
        'car_id' => 'sometimes|exists:cars,id',
        'start_date' => 'sometimes|date',
        'expected_end_date' => 'sometimes|date|after_or_equal:start_date',
        'actual_end_date' => 'nullable|date|after_or_equal:start_date|required_with:end_km',
        'daily_rate' => 'sometimes|numeric|min:0',
        'start_km' => 'sometimes|integer|min:0',
        'end_km' => 'nullable|integer|min:0|required_with:actual_end_date',
    ];
}

}
