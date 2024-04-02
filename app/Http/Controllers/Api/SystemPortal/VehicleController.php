<?php

namespace App\Http\Controllers\Api\SystemPortal;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    public function index (Request $request)
    {
        if ($request->active) {
            return Vehicle::where('is_active', 1)->get();
        }

        return Vehicle::all();
    }

    public function store (Request $request)
    {
        $request->validate([
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'name' => 'required|unique:vehicles,name',
            'plate_no' => 'required|unique:vehicles,plate_no',
        ]);

        return Vehicle::create($request->all());
    }

    public function update (Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'name' => 'required|unique:vehicles,name,' . $vehicle->id,
            'plate_no' => 'required|unique:vehicles,plate_no,' . $vehicle->id,
        ]);

        return $vehicle->update($request->all());
    }
}
