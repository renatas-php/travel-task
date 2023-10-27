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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->integer('hotel_id');
            $table->string('hotel_name');
            $table->integer('hotel_rating')->nullable();
            $table->string('room_name')->nullable();
            $table->string('departure_airport')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('country_name')->nullable();
            $table->string('operator')->nullable();
            $table->string('list_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
