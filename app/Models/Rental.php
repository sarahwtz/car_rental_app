<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'car_id', 'start_date', 
                         'expected_end_date', 'actual_end_date', 
                         'daily_rate', 'start_km', 'end_km'];

    public function client() {
     return $this->belongsTo(Client::class);
    }

    public function car() {
        return $this->belongsTo(Car::class);
    }

}
