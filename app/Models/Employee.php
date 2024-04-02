<?php

namespace App\Models;

use App\Models\DailyTimeRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $appends = ['full_name'];

    protected $fillable = [
        'employee_type',
        'first_name',
        'middle_name',
        'last_name',
        'position',
        'date_hired',

        'employment_type',
        'regular_employment_date',

        'schedule_in',
        'schedule_out',

        'is_active'
    ];

    protected $casts = [
        'date_hired' => 'date:Y-m-d',
        'schedule_in' => 'date:H:i',
        'schedule_out' => 'date:H:i',
        'regular_employment_date' => 'date:Y-m-d',
    ];

    public function getFullNameAttribute()
    {
        return $this->last_name . ', ' . $this->first_name . ', ' . $this->middle_name;
    }

    public function dailyTimeRecords ()
    {
        return $this->hasMany(DailyTimeRecord::class);
    }

    public function dailyTimeRecord ()
    {
        return $this->hasOne(DailyTimeRecord::class);
    }

    public function attendances ()
    {
        return $this->hasMany(Attendance::class);
    }
}
