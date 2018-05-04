<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function getCarsIndex(Request $request) {
        $query = Car::where('make', 'like', '%' . $request->input('make') . '%')
            ->where('name', 'like', '%' . $request->input('name') . '%')
            ->where('category', 'like', '%' . $request->input('category') . '%');
            //->orderBy('price', 'desc');

        $cars = $query->paginate(30);
        $count = $query->count();

        $makes = Car::select('make')->groupBy('make')->get();
        $categories = Car::select('category')->groupBy('category')->get();

        return view('cars.index', ['cars' => $cars->appends($request->except('page')), 'count' => $count, 'makes' => $makes, 'categories' => $categories]);
    }

    public function getCarsView($id) {
        $car = Car::select("*", DB::raw("ROUND((speed + acceleration + braking + cornering + stability) / 5, 1) as average"))
            ->where('id', $id)
            ->first();

        return view('cars.view', ['car' => $car]);
    }
}
