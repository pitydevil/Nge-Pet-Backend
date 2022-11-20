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
        Schema::create('supported_pet_types', function (Blueprint $table) {
            $table->id("supported_pet_type_id");
            $table->longText("supported_pet_type_short_size");
            $table->longText("supported_pet_type_size");
            $table->longText("supported_pet_type_description");
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
        Schema::dropIfExists('supported_pet_types');
    }
};
