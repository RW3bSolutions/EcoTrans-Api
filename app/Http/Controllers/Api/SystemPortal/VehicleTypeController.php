<?php

namespace App\Http\Controllers\Api\SystemPortal;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index (Request $request)
    {
        if ($request->active) {
            return VehicleType::where('is_active', 1)->get();
        }

        return VehicleType::all();
    }

    public function store (Request $request)
    {
        $request->validate([
            'name' => 'required|unique:vehicle_types,name',
        ]);

        return VehicleType::create($request->all());
    }

    public function update (Request $request, VehicleType $vehicleType)
    {
        $request->validate([
            'name' => 'required|unique:vehicle_types,name,' . $vehicleType->id,
        ]);

        return $vehicleType->update($request->all());
    }
}
