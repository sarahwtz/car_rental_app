<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image'];


    public function carModels() {
    return $this->hasMany(CarModel::class);
}

    public function rules(){
        return [
            'name' => 'required|unique:brands,name,'.$this->id.'|min:3',
            'image' => 'required'
        ];

    }

    public function feedback(){
        return [
            'required' => 'The :attribute field is required',
            'name.unique' => 'This Brand name already exists',
            'name.min' => 'The name must be at least 3 characters long.'
        ];

    }

}

