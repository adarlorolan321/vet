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
        Schema::create('apointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pet_id');
            $table->string('date');
            $table->string('time_start');
            $table->string('time_end');
            $table->string('payment_amount');
            $table->string('payment_method');
            $table->string('service_id');
            $table->string('payment_status');
            $table->string('status');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apointments', function (Blueprint $table) {
            Schema::dropIfExists('apointments');
        });
    }
};
