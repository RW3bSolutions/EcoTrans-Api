<?php

namespace App\Http\Controllers\Api\SystemPortal;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index (Request $request)
    {
        if ($request->active) {
            return Employee::where('is_active', 1)->get();
        }

        return Employee::all();
    }

    public function store (Request $request)
    {
        $request->validate([
            'employee_type' => 'required|in:Staff,Driver',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'position' => 'required',
            'date_hired' => 'required|date',
            'employment_type' => 'required|in:Regular,Probationary',
            'regular_employment_date' => 'nullable|date',
            'schedule_in' => 'required|date_format:H:i',
            'schedule_out' => 'required|date_format:H:i',
        ]);

        return Employee::create($request->all());
    }

    public function update (Request $request, Employee $employee)
    {
        $request->validate([
            'employee_type' => 'required|in:Staff,Driver',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'position' => 'required',
            'date_hired' => 'required|date',
            'employment_type' => 'required|in:Regular,Probationary',
            'regular_employment_date' => 'nullable|date',
            'schedule_in' => 'required|date_format:H:i',
            'schedule_out' => 'required|date_format:H:i',
        ]);

        return $employee->update($request->all());
    }

    public function show ($id)
    {
        return Employee::find($id);
    }

}
