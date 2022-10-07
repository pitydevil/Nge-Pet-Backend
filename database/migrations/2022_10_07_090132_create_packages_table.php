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
            $table->id('package_id')->index();
            $table->foreignId('fasilitas_id')->constrained('fasilitas', 'fasilitas_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('supported_pet_id')->constrained('supported_pets', 'supported_pet_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->bigInteger('package_price');
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
