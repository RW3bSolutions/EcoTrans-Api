<?php

namespace App\Http\Controllers\Api\SystemPortal;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\PayrollPeriod;
use App\Http\Controllers\Controller;

class PayrollPeriodController extends Controller
{
    public function index (Request $request)
    {
        return PayrollPeriod::all();
    }

    public function store (Request $request)
    {
        $request->validate([
            'date_from' => 'required|date|unique:payroll_periods,date_from',
            'date_to' => 'required|date|unique:payroll_periods,date_to',
        ]);

        return PayrollPeriod::create($request->all());
    }

    public function update (Request $request, PayrollPeriod $payrollPeriod)
    {
        $request->validate([
            'date_from' => 'required|date|unique:payroll_periods,date_from,' . $payrollPeriod->id,
            'date_to' => 'required|date|unique:payroll_periods,date_to,' . $payrollPeriod->id,
        ]);

        return $payrollPeriod->update($request->all());
    }

    public function show (Request $request, PayrollPeriod $payrollPeriod)
    {
        $dates = [];
        $startTime = strtotime($payrollPeriod->date_from);
        $endTime = strtotime($payrollPeriod->date_to);

        for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
          $dates[] = [
            'date' => date( 'Y-m-d', $i ),
            'time_in' => null,
            'time_out' => null,
            'break' => 1,
            'undertime' => 0,
            'late' => 0,
            'absent' => 0,
            'sunday' => 0,
            'special_holiday' => 0,
            'regular_holiday' => 0,
            'no_work' => date('N', strtotime(date( 'Y-m-d', $i ))) === 'Sunday' ? 1 : 0,
          ];
        }

        $active_employees = Employee::orderBy('last_name', 'ASC')->with('dailyTimeRecords', function ($q) use ($payrollPeriod) {
            $q->where('payroll_period_id', $payrollPeriod->id);
        })->with('attendances', function ($query) use ($payrollPeriod) {
            $query->where('payroll_period_id', $payrollPeriod->id);
        })->get();

        return [
            'active_employees' => $active_employees,
            'payroll_period' => $payrollPeriod,
            'dates' => $dates
        ];
    }
}
