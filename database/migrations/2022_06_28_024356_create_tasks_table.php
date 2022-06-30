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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')->on('stages')->references('id');
            $table->string('company_name');
            $table->string('it_is')->nullable();
            $table->string('material')->nullable();
            $table->string('total_cards')->nullable();
            $table->string('instruction')->nullable();
            $table->string('background')->nullable();
            $table->text('design_comments')->nullable();
            $table->text('card_details')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('emirate')->nullable();
            $table->text('address')->nullable();
            $table->json('design_attachments')->nullable();
            $table->json('card_details_attachments')->nullable();
            $table->json('qr_attachments')->nullable();

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
        Schema::dropIfExists('tasks');
    }
};
