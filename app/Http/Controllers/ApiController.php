<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /* MAKES */

    public function apiMakesIndex()
    {
        $makes = Car::select('make')
            ->groupBy('make')
            ->orderBy('make')
            ->limit(5)
            ->get();

        return response()->json($makes, 200);
    }

    public function apiMakesGet($make)
    {
        $makes = Car::select('make')
            ->where('make', 'LIKE', $make . "%")
            ->groupBy('make')
            ->orderBy('make')
            ->limit(5)
            ->get();

        return response()->json($makes, 200);
    }

    /* CATEGORIES */

    public function apiCategoriesIndex()
    {
        $categories = Car::select('category')
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        return response()->json($categories, 200);
    }

    public function apiCategoriesGet($category)
    {
        $categories = Car::select('category')
            ->where('category', 'LIKE', $category . "%")
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        return response()->json($categories, 200);
    }

    /* Drives */

    public function apiDrivesIndex()
    {
        $drives = Car::select('drive')
            ->groupBy('drive')
            ->orderBy('drive')
            ->get();

        return response()->json($drives, 200);
    }

    public function apiDrivesGet($drive)
    {
        $drives = Car::select('drive')
            ->where('drive', 'LIKE', $drive . "%")
            ->groupBy('drive')
            ->orderBy('drive')
            ->get();

        return response()->json($drives, 200);
    }
}
