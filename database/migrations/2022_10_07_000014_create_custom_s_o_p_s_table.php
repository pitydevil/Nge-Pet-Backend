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
        Schema::create('custom_sops', function (Blueprint $table) {
            $table->id("custom_sop_id");
            $table->longText("custom_sop_name");
            $table->foreignId('order_detail_id')->constrained('order_details', 'order_detail_id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('monitoring_id')->constrained('monitorings', 'monitoring_id')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('custom_sops');
    }
};
