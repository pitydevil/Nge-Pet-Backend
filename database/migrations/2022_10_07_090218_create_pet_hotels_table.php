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
            $table->id('pet_hotel_id')->index();
            $table->foreignId('sop_generals_id')->constrained('sop_generals', 'sop_generals_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('asuransi_id')->constrained('asuransis', 'asuransi_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('package_id')->constrained('packages', 'package_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('cancel_sops_id')->constrained('cancel_sops', 'cancel_sops_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('fasilitas_id')->constrained('fasilitas', 'fasilitas_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('supported_pet_id')->constrained('supported_pets', 'supported_pet_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->longText('pet_hotel_name');
            $table->double('pet_hotel_latitude');
            $table->double('pet_hotel_longitude');
            $table->longText('pet_hotel_location');
            $table->longText('pet_hotel_description');
            $table->foreignId('pet_hotel_image_id')->constrained('pet_hotel_images', 'pet_hotel_image_id')->cascadeOnUpdate()->restrictOnDelete();
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
