<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['id','make','name','category','speed','acceleration','braking',
        'cornering','stability','power','price','drive'];

    //
}
