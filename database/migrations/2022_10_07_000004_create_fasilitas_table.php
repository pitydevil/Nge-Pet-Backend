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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id('fasilitas_id');
            $table->longText('fasilitas_name');
            $table->longText('fasilitas_icon_url');
            $table->longText('fasilitas_status');
            $table->foreignId('pet_hotel_id')->constrained('pet_hotels', 'pet_hotel_id')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('fasilitas');
    }
};
