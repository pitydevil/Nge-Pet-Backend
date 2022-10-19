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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('order_detail_id');
            $table->longText('pet_name');
            $table->longText('pet_type');
            $table->longText('pet_size');
            $table->bigInteger('order_detail_price');
            $table->foreignId('package_id')->constrained('packages', 'package_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('order_id')->constrained('orders', 'order_id')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('order_details');
    }
};
