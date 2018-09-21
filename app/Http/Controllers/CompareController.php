<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompareController extends Controller
{
    public function getCompareIndex(Request $request)
    {
        if ($request->session()->has('compare_cars')) {
            $compare_cars = $request->session()->get('compare_cars');
        } else {
            $compare_cars = [];
        }

        $cars = Car::select('cars.*', DB::raw("ROUND((speed + acceleration + braking + cornering + stability) / 5, 1) as average, IFNULL(garage_cars.car_count, 0) as car_count"))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->whereIn('cars.id', $compare_cars)
            ->orderBy('make')
            ->orderBy('name')
            ->get();

        return view('compare.index', ['cars' => $cars]);
    }

    public function postCompareIndex(Request $request)
    {
        if ($request->has('car_id')) {
            $compare_cars = $request->session()->get('compare_cars');
            $to_remove = array($request->input('car_id'));
            $compare_cars = array_diff($compare_cars, $to_remove);

            $request->session()->put('compare_cars', $compare_cars);
        } else {
            $request->session()->put('compare_cars', []);
        }

        return redirect()->route('compare.index')->with('info', "Selection modified");
    }
}
