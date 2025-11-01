<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'required|min:3|unique:brands,name',
            'image' => 'required|file|mimes:png'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required',
            'image.mimes' => 'Please upload a PNG image file',
            'name.unique' => 'This Brand name already exists',
            'name.min' => 'The name must be at least 3 characters long.',
        ];
    }
}
