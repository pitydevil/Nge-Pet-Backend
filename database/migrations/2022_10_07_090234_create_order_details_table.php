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
            $table->id('order_detail_id')->index();
            $table->foreignId('order_id')->constrained('orders', 'order_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('monitoring_id')->constrained('monitorings', 'monitoring_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->longText('pet_name');
            $table->longText('pet_type');
            $table->foreignId('package_id')->constrained('packages', 'package_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->bigInteger('order_detail_price');
            $table->foreignId('custom_sop_id')->constrained('custom_sops', 'custom_sop_id')->cascadeOnUpdate()->restrictOnDelete();
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
