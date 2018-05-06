<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['id','make','name','category','speed','acceleration','braking',
        'cornering','stability','power','price','drive'];

    public function garageCars() {
        return $this->hasMany('\App\GarageCar', 'car_id', 'id');
    }
}
