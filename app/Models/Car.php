<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function carModel() {
        return $this->belongsTo(CarModel::class, 'model_id');
    }

    public function rentals() {
     return $this->hasMany(Rental::class);
}

}
