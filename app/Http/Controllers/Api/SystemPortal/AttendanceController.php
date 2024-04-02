<?php

namespace App\Http\Controllers\Api\SystemPortal;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index (Request $request)
    {
        if ($request->employee_id) {
            return Attendance::with('payrollPeriod', 'employee', 'dailyTimeRecords')->where('employee_id', $request->employee_id)->get();
        }

        return Attendance::with('payrollPeriod', 'employee', 'dailyTimeRecords')->get();
    }
}
