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
        Schema::create('billing_statements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bs_no');
            $table->bigInteger('client_id');
            $table->date('date');
            $table->string('tin')->nullable();
            $table->string('terms')->nullable();
            $table->longText('address')->nullable();
            $table->longText('items')->nullable();
            $table->double('vatable_amount')->default(0);
            $table->double('vat_amount')->default(0);
            $table->double('total_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_statements');
    }
};
