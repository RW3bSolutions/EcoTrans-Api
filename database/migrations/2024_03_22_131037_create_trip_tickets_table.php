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
        Schema::create('trip_tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('trip_no');
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->bigInteger('vehicle_id')->nullable();
            $table->date('date');

            $table->double('odo_end')->default(0);
            $table->double('total_kms_ran')->default(0);
            $table->double('total_no_of_hrs')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_tickets');
    }
};
