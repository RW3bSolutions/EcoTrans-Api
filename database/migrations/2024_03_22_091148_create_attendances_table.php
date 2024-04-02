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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payroll_period_id')->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->double('total_working_days')->default(0);
            $table->double('total_break')->default(0);
            $table->double('total_undertime')->default(0);
            $table->double('total_late')->default(0);
            $table->double('total_absent')->default(0);
            $table->double('total_sunday')->default(0);
            $table->double('total_special_holiday')->default(0);
            $table->double('total_regular_holiday')->default(0);
            $table->double('total_no_work')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
