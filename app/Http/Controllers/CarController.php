<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function getCarsIndex() {
        $cars = Car::paginate(30);

        return view('cars.index', ['cars' => $cars]);
    }

    public function getCarsView($id) {
        $car = Car::select("*", DB::raw("ROUND((speed + acceleration + braking + cornering + stability) / 5, 1) as average"))
            ->where('id', $id)
            ->first();

        return view('cars.view', ['car' => $car]);
    }
}
