<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentalRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date|after_or_equal:start_date',
            'actual_end_date' => 'nullable|date|after_or_equal:start_date',
            'daily_rate' => 'required|numeric|min:0',
            'start_km' => 'required|integer|min:0',
            'end_km' => 'nullable|integer|min:0',
        ];
    }
}



