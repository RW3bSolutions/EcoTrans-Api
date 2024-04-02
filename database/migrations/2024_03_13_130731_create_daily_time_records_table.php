<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_time_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attendance_id')->nullable();
            $table->bigInteger('payroll_period_id')->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->date('date');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->double('break')->default(0);
            $table->double('undertime')->default(0);
            $table->double('late')->default(0);
            $table->double('absent')->default(0);
            $table->double('sunday')->default(0);
            $table->double('special_holiday')->default(0);
            $table->double('regular_holiday')->default(0);
            $table->double('no_work')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_time_records');
    }
};
