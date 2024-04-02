<?php

namespace App\Http\Controllers\Api\SystemPortal;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\DailyTimeRecord;
use App\Http\Controllers\Controller;
use App\Models\PayrollPeriod;

class DailyTimeRecordController extends Controller
{

    public function store (Request $request)
    {
        $request->validate([
            'daily_time_records' => 'required|array',
            'payroll_period_id' => 'required|exists:payroll_periods,id',
            'employee_id' => 'required|exists:employees,id',
            'total_break' => 'required|numeric',
            'total_undertime' => 'required|numeric',
            'total_late' => 'required|numeric',
            'total_absent' => 'required|numeric',
            'total_sunday' => 'required|numeric',
            'total_special_holiday' => 'required|numeric',
            'total_regular_holiday' => 'required|numeric',
            'total_no_work' => 'required|numeric',
        ]);

        $attendance = Attendance::create($request->all());

        foreach ($request->daily_time_records as $key => $value) {
            DailyTimeRecord::create([
                'attendance_id' => $attendance->id,
                'payroll_period_id' => $request->payroll_period_id,
                'employee_id' => $request->employee_id,
                'date' => $value['date'],
                'time_in' => $value['time_in'],
                'time_out' => $value['time_out'],
                'break' => $value['break'],
                'late' => $value['late'],
                'absent' => $value['absent'],
                'sunday' => $value['sunday'],
                'special_holiday' => $value['special_holiday'],
                'regular_holiday' => $value['regular_holiday'],
                'no_work' => $value['no_work'],
            ]);
        }

        $payrollPeriod = PayrollPeriod::find($request->payroll_period_id);

        $active_employees = Employee::orderBy('last_name', 'ASC')->with('dailyTimeRecords', function ($q) use ($payrollPeriod) {
            $q->where('payroll_period_id', $payrollPeriod->id);
        })->with('attendances', function ($query) use ($payrollPeriod) {
            $query->where('payroll_period_id', $payrollPeriod->id);
        })->get();

        return $active_employees;
    }

}
