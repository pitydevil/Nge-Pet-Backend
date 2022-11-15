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
        Schema::create('pet_hotels', function (Blueprint $table) {
            $table->id('pet_hotel_id');
            $table->longText('pet_hotel_name');
            $table->longText('pet_hotel_description');
            $table->double('pet_hotel_longitude');
            $table->double('pet_hotel_latitude');
            $table->longText('pet_hotel_address');
            $table->longText('pet_hotel_kelurahan');
            $table->longText('pet_hotel_kecamatan');
            $table->longText('pet_hotel_kota');
            $table->longText('pet_hotel_provinsi');
            $table->integer('pet_hotel_pos');
            $table->integer('supported_pet_status');
            $table->foreignId('owner_id')->constrained('owners', 'owner_id')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('pet_hotels');
    }
};
