<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\PayrollPeriod;
use App\Models\DailyTimeRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_period_id',
        'employee_id',
        'total_working_days',
        'total_break',
        'total_undertime',
        'total_late',
        'total_absent',
        'total_sunday',
        'total_special_holiday',
        'total_regular_holiday',
        'total_no_work',
    ];

    public function payrollPeriod ()
    {
        return $this->belongsTo(PayrollPeriod::class);
    }

    public function employee ()
    {
        return $this->belongsTo(Employee::class);
    }

    public function dailyTimeRecords ()
    {
        return $this->hasMany(DailyTimeRecord::class);
    }
}
