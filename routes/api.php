<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;

use App\Http\Controllers\Api\SystemPortal as SystemPortalController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
});

Route::prefix('system')->middleware(['auth:sanctum'])->group(function () {
    Route::resource('dashboard', SystemPortalController\DashboardController::class)->only('index');
    Route::resource('users', SystemPortalController\UserController::class)->only('index','store','update');
    Route::resource('vehicle-types', SystemPortalController\VehicleTypeController::class)->only('index','store','update');
    Route::resource('vehicles', SystemPortalController\VehicleController::class)->only('index','store','update');
    Route::resource('clients', SystemPortalController\ClientController::class)->only('index','store','update');
    Route::resource('employees', SystemPortalController\EmployeeController::class)->only('index','store','update','show');
    Route::resource('payroll-periods', SystemPortalController\PayrollPeriodController::class)->only('index','store','update','show');
    Route::resource('daily-time-records', SystemPortalController\DailyTimeRecordController::class)->only('index','store','update');
    Route::resource('attendances', SystemPortalController\AttendanceController::class)->only('index','store','update');
    Route::resource('billing-statements', SystemPortalController\BillingStatementController::class)->only('index','store','update');
});
