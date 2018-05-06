<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GarageCar extends Model
{
    protected $fillable = ['id','car_id','car_count'];

    public function car() {
        return $this->belongsTo('\App\Car', 'car_id', 'id');
    }
}
