<?php

namespace App\Http\Controllers;

use App\Car;
use App\GarageCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatController extends Controller
{
    public function getStatsIndex()
    {
        $car_list_make = Car::select('cars.make', DB::raw('COUNT(garage_cars.id) as garage_ct,COUNT(cars.id) as ct,ROUND(COUNT(garage_cars.id) / COUNT(cars.id) * 100, 1) as prc'))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->groupBy('cars.make')
            ->get();

        $car_list_cat = Car::select('cars.category', DB::raw('COUNT(garage_cars.id) as garage_ct,COUNT(cars.id) as ct,ROUND(COUNT(garage_cars.id) / COUNT(cars.id) * 100, 1) as prc'))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->groupBy('cars.category')
            ->get();

        $total = Car::select(DB::raw('ROUND(COUNT(garage_cars.id) / COUNT(cars.id) * 100, 1) as prc'))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->first();

        $not_owned_cars_price = Car::select('cars.price')
            ->whereNotIn('cars.id', function ($query){
                $query->select('cars.id')
                    ->from('cars')
                    ->rightJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
                    ->get();
            })
            ->sum('cars.price');

        $count = GarageCar::sum('car_count');

        $garagevalue = Car::select(DB::raw('SUM(garage_cars.car_count * cars.price) as value'))
            ->rightJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->first();

        return view('stats.index', ['car_list_make' => $car_list_make, 'car_list_cat' => $car_list_cat, 'total_prc' => $total->prc, 'count' => $count, 'garagevalue' => $garagevalue, 'not_owned_cars_price' => $not_owned_cars_price]);
    }
}
