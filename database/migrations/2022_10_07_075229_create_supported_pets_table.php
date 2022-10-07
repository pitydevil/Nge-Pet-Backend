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
        Schema::create('supported_pets', function (Blueprint $table) {
            $table->id('supported_pet_id');
            $table->longText('supported_pet_name');
            $table->foreignId('supported_pet_type_id')->constrained('supported_pet_types', 'supported_pet_type_id')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('supported_pets');
    }
};
