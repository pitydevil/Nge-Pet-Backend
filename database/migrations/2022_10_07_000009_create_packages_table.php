<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id('package_id');
            $table->longText('package_name');
            $table->bigInteger('package_price');
            $table->foreignId('pet_hotel_id')->constrained('pet_hotels', 'pet_hotel_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('supported_pet_id')->constrained('supported_pets', 'supported_pet_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
