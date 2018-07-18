<?php

namespace App\Http\Controllers;

use App\Car;
use App\GarageCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    // HOMEPAGE
    public function getHomePage()
    {
        $latest_cars = Car::select('make', 'name')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

        return view('pages.index', ['latest_cars' => $latest_cars]);
    }

    // TODO: NAMES
    public function getCarsIndex(Request $request)
    {
        $query = Car::select('cars.*', 'garage_cars.car_count')
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->where('make', 'like', '%' . $request->input('make') . '%')
            ->where('name', 'like', '%' . $request->input('name') . '%')
            ->where('category', 'like', '%' . $request->input('category') . '%')
            ->orderBy('make')
            ->orderBy('name');

        $cars = $query->paginate(30);
        $count = $query->count();

        $makes = Car::select('make')->groupBy('make')->get();
        $categories = Car::select('category')->groupBy('category')->get();

        return view('cars.index', ['cars' => $cars->appends($request->except('page')), 'count' => $count, 'makes' => $makes, 'categories' => $categories]);
    }

    public function getCarsView($id)
    {
        $car = Car::select("cars.*", DB::raw("ROUND((speed + acceleration + braking + cornering + stability) / 5, 1) as average, IFNULL(garage_cars.car_count, 0) as car_count"))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->where('cars.id', $id)
            ->first();

        return view('cars.view', ['car' => $car]);
    }

    public function getCarsEdit($id)
    {
        $car = Car::select('cars.*', DB::raw('IFNULL(garage_cars.car_count, 0) as count'))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->where('cars.id', $id)
            ->first();

        return view('cars.edit', ['car' => $car]);
    }

    public function postCarsEdit($id, Request $request)
    {
        $this->validate($request, [
            'make' => 'required',
            'name' => 'required',
            'category' => 'required',
            'speed' => 'required|numeric|min:0|max:10',
            'acceleration' => 'required|numeric|min:0|max:10',
            'braking' => 'required|numeric|min:0|max:10',
            'cornering' => 'required|numeric|min:0|max:10',
            'stability' => 'required|numeric|min:0|max:10',
            'power' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'drive' => 'required',
            'count' => 'required|numeric|min:0'
        ]);

        // Car
        $car = Car::find($id);

        $car->make = $request->input('make');
        $car->name = $request->input('name');
        $car->category = $request->input('category');
        $car->speed = $request->input('speed');
        $car->acceleration = $request->input('acceleration');
        $car->braking = $request->input('braking');
        $car->cornering = $request->input('cornering');
        $car->stability = $request->input('stability');
        $car->power = $request->input('power');
        $car->price = $request->input('price');
        $car->drive = $request->input('drive');

        $car->save();

        // Garage car
        $garagecar = GarageCar::where('car_id', $id)->first();

        if ($garagecar == null && $request->input('count') != 0) {
            $garagecar = new GarageCar([
                'car_id' => $id,
                'car_count' => $request->input('count')
            ]);
            $garagecar->save();
        } else if ($garagecar != null) {
            if ($request->input('count') != 0) {
                $garagecar->car_count = $request->input('count');
                $garagecar->save();
            } else {
                $garagecar->delete();
            }
        }

        return redirect()->back()->with('info', 'Car updated');
    }

    public function getCarsNew()
    {
        return view('cars.new');
    }

    public function postCarsNew(Request $request)
    {
        $this->validate($request, [
            'make' => 'required',
            'name' => 'required',
            'category' => 'required',
            'speed' => 'required|numeric|min:0|max:10',
            'acceleration' => 'required|numeric|min:0|max:10',
            'braking' => 'required|numeric|min:0|max:10',
            'cornering' => 'required|numeric|min:0|max:10',
            'stability' => 'required|numeric|min:0|max:10',
            'power' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'drive' => 'required',
        ]);

        $car = new Car([
            'make' => $request->input('make'),
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'speed' => $request->input('speed'),
            'acceleration' => $request->input('acceleration'),
            'braking' => $request->input('braking'),
            'cornering' => $request->input('cornering'),
            'stability' => $request->input('stability'),
            'power' => $request->input('power'),
            'price' => $request->input('price'),
            'drive' => $request->input('drive'),
        ]);
        $car->save();

        return redirect()->route('cars.index')->with('info', $car->name . " added");
    }

    /* STATS */

    public function getStatsIndex()
    {
        $stat_list = Car::select('cars.make', DB::raw('COUNT(garage_cars.id) as garage_ct,COUNT(cars.id) as ct,ROUND(COUNT(garage_cars.id) / COUNT(cars.id) * 100, 1) as prc'))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->groupBy('cars.make')
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

        return view('stats.index', ['stat_list' => $stat_list, 'total_prc' => $total->prc, 'count' => $count, 'garagevalue' => $garagevalue, 'not_owned_cars_price' => $not_owned_cars_price]);
    }
}
