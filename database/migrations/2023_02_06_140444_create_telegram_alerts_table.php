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
        Schema::create('telegram_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('text');
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->foreign('stage_id')->on('stages')->references('id');
            $table->unsignedBigInteger('inventory_id')->nullable();
//            $table->foreign('inventory_id')->on('inventories')->references('id');
            $table->unsignedBigInteger('available_less_then')->nullable();
            $table->json('recipient_ids');
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
        Schema::dropIfExists('telegram_alerts');
    }
};
