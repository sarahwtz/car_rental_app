<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       
        $id = $this->route('brand');

        return [
            'name' => 'sometimes|min:3|unique:brands,name,'.$id,
            'image' => 'sometimes|file|mimes:png'
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => 'Please upload a PNG image file',
            'name.unique' => 'This Brand name already exists',
            'name.min' => 'The name must be at least 3 characters long.',
        ];
    }
}
