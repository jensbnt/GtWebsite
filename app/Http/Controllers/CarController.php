<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function getCarsIndex() {
        $cars = Car::paginate(30);

        return view('cars.index', ['cars' => $cars]);
    }
}
