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
        Schema::create('sop_generals', function (Blueprint $table) {
            $table->id('sop_generals_id');
            $table->longText('sop_generals_description');
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
        Schema::dropIfExists('sop_generals');
    }
};
