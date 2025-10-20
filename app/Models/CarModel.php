<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class CarModel extends Model
{
    use HasFactory;

     protected $fillable = ['brand_id', 'name', 'image', 'doors_count', 'seats', 'air_bag', 'abs'];



 

public function rules(){
    return [
        'brand_id' => 'required|exists:brands,id',
        'name' => 'required|unique:car_models,name,'.$this->id.'|min:3',
        'image' => 'required|file|mimes:png,jpeg,jpg',
        'doors_count' => 'required|integer|digits_between:1,5',
        'seats' => 'required|integer|digits_between:1,20',
        'air_bag' => 'required|boolean',
        'abs' => 'required|boolean'
    ];
}

public function feedback(){
    return [
        'required' => 'The :attribute field is required',
        'name.unique' => 'This CarModel name already exists',
        'name.min' => 'The name must be at least 3 characters long',
        'brand_id.exists' => 'The selected brand does not exist',
        'image.file' => 'The uploaded file must be a valid file',
        'image.mimes' => 'The image must be a file of type: png, jpeg, jpg',
        'doors_count.integer' => 'Doors count must be an integer',
        'doors_count.digits_between' => 'Doors count must be between 1 and 5 digits',
        'seats.integer' => 'Seats must be an integer',
        'seats.digits_between' => 'Seats must be between 1 and 20 digits',
        'air_bag.boolean' => 'Air bag must be true or false',
        'abs.boolean' => 'ABS must be true or false',
    ];
}


    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function cars() {
        return $this->hasMany(Car::class, 'model_id');
    }

}
