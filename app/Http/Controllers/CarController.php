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
        $last_acquired_cars = Car::select('make', 'name')
            ->rightJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->orderBy('garage_cars.updated_at', 'desc')
            ->limit(10)
            ->get();

        return view('pages.index', ['last_acquired_cars' => $last_acquired_cars]);
    }

    // TODO: NAMES
    public function getCarsIndex(Request $request)
    {
        $cars = Car::select('cars.*', 'garage_cars.car_count')
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->where('make', 'like', '%' . $request->input('make') . '%')
            ->where('name', 'like', '%' . $request->input('name') . '%')
            ->where('category', 'like', '%' . $request->input('category') . '%')
            ->orderBy('make')
            ->orderBy('name')
            ->paginate(30);

        $makes = Car::select('make')->groupBy('make')->get();
        $categories = Car::select('category')->groupBy('category')->get();

        return view('cars.index', ['cars' => $cars->appends($request->except('page')), 'makes' => $makes, 'categories' => $categories]);
    }

    public function getCarsView($id, Request $request)
    {
        $car = Car::select("cars.*", DB::raw("ROUND((speed + acceleration + braking + cornering + stability) / 5, 1) as average, IFNULL(garage_cars.car_count, 0) as car_count"))
            ->leftJoin('garage_cars', 'cars.id', 'garage_cars.car_id')
            ->where('cars.id', $id)
            ->first();

        return view('cars.view', ['car' => $car]);
    }

    public function postCarsView($id, Request $request)
    {
        $max_cars = 3;

        if (!is_array($request->session()->get('compare_cars'))) {
            $request->session()->remove('compare_cars');
            $request->session()->put('compare_cars', []);
        }

        $size = count($request->session()->get('compare_cars'));

        if ($size >= $max_cars) {
            return redirect()->route('cars.view', ['id' => $id])->with('compare', "Maximum selection reached (" . $size . "/" . $max_cars . ")");
        } elseif (!in_array($id, $request->session()->get('compare_cars'))) {
            $request->session()->push('compare_cars', $id);
            $request->session()->save();
            return redirect()->route('cars.view', ['id' => $id])->with('compare', "Selection added (" . ($size + 1) . "/" . $max_cars . ")");
        } else {
            return redirect()->route('cars.view', ['id' => $id])->with('compare', "Already selected");
        }

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

        return redirect()->route('cars.view', ['id' => $car->id])->with('info', $car->name . " added");
    }
}
