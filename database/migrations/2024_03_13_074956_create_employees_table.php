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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_type');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');

            $table->string('position');
            $table->date('date_hired');

            $table->string('employment_type');
            $table->date('regular_employment_date')->nullable();

            $table->time('schedule_in');
            $table->time('schedule_out');

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
