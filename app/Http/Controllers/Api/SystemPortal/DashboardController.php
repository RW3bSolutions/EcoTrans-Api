<?php

namespace App\Http\Controllers\Api\SystemPortal;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index (Request $request)
    {
        $date = Carbon::now()->subMonths(6)->format('Y-m-d');
        $regularizations = Employee::where('employment_type', 'Probationary')->where('date_hired', '<=', $date)->get();

        return [
            'date' => $date,
            'regularizations' => $regularizations
        ];
    }

}
