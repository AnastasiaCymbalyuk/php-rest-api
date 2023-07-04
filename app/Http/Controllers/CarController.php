<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Car::paginate();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return Car::created($request);
    }
   
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Car::findOFFaill($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $car->fill($request->validation());
        return $car->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->delete()) {
            return response(null, 404);
        }
        return null;
    }
}
