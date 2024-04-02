<?php

namespace App\Models;

use App\Models\PayrollPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyTimeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'payroll_period_id',
        'employee_id',
        'date',
        'time_in',
        'time_out',
        'break',
        'late',
        'undertime',
        'absent',
        'sunday',
        'special_holiday',
        'regular_holiday',
        'no_work',

    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'time_in' => 'date::H:i',
        'time_out' => 'date::H:i',
    ];

    public function payrollPeriod ()
    {
        return $this->belongsTo(PayrollPeriod::class);
    }


}
