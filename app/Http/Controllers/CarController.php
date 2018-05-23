<?php

namespace App\Http\Controllers;

use App\Car;
use App\GarageCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function getCarsIndex(Request $request) {
        $query = Car::select('cars.*', 'garage_cars.car_count')
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->where('make', 'like', '%' . $request->input('make') . '%')
            ->where('name', 'like', '%' . $request->input('name') . '%')
            ->where('category', 'like', '%' . $request->input('category') . '%')
            ->orderBy('make');

        $cars = $query->paginate(30);
        $count = $query->count();

        $makes = Car::select('make')->groupBy('make')->get();
        $categories = Car::select('category')->groupBy('category')->get();

        return view('cars.index', ['cars' => $cars->appends($request->except('page')), 'count' => $count, 'makes' => $makes, 'categories' => $categories]);
    }

    public function getCarsView($id) {
        $car = Car::select("cars.*", DB::raw("ROUND((speed + acceleration + braking + cornering + stability) / 5, 1) as average, IFNULL(garage_cars.car_count, 0) as car_count"))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->where('cars.id', $id)
            ->first();

        return view('cars.view', ['car' => $car]);
    }

    public function getCarsEdit($id) {
        $car = Car::select('cars.*', DB::raw('IFNULL(garage_cars.car_count, 0) as car_count'))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->where('cars.id', $id)
            ->first();

        return view('cars.edit', ['car' => $car]);
    }

    public function postCarsEdit($id, Request $request) {
        $this->validate($request, [
            'car_count' => 'required|numeric|min:0'
        ]);

        $garagecar = GarageCar::where('car_id', $id)->first();

        if($garagecar == null && $request->input('car_count') != 0) {
            $garagecar = new GarageCar([
                'car_id' => $id,
                'car_count' => $request->input('car_count')
            ]);
            $garagecar->save();
        } else if($garagecar != null) {
            if($request->input('car_count') != 0) {
                $garagecar->car_count = $request->input('car_count');
                $garagecar->save();
            } else {
                $garagecar->delete();
            }
        }



        return redirect()->back()->with('info', 'Car updated');
    }

    /* STATS */

    public function getStatsIndex() {
        $stat_list = Car::select('cars.make', DB::raw('COUNT(garage_cars.id) as garage_ct,COUNT(cars.id) as ct,ROUND(COUNT(garage_cars.id) / COUNT(cars.id) * 100, 1) as prc'))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->groupBy('cars.make')
            ->get();

        $total = Car::select(DB::raw('ROUND(COUNT(garage_cars.id) / COUNT(cars.id) * 100, 1) as prc'))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->first();

        $count = GarageCar::sum('car_count');

        $garagevalue = Car::select(DB::raw('SUM(garage_cars.car_count * cars.price) as value'))
            ->rightJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->first();

        return view('stats.index', ['stat_list' => $stat_list, 'total_prc' => $total->prc, 'count' => $count, 'garagevalue' => $garagevalue]);
    }
}
