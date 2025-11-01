<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory; protected $fillable = ['model_id', 'license_plate', 'available', 'km'];
 

public function rules(){
    return [
        'model_id' => 'required|exists:car_models,id',
        'license_plate' => 'required',
        'available' => 'required',
        'km' => 'required'
    ];
}

    public function carModel() {
        return $this->belongsTo(CarModel::class, 'model_id');
    }

    public function rentals() {
     return $this->hasMany(Rental::class);
}

}
