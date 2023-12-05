<?php

use App\Models\Stage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')->on('stages')->references('id');
            $table->text('name')->nullable();
            $table->text('company_name')->nullable();
            $table->text('it_is')->nullable();
            $table->text('material')->nullable();
            $table->text('total_cards')->nullable();
            $table->text('instruction')->nullable();
            $table->text('background')->nullable();
            $table->text('design_comments')->nullable();
            $table->text('card_details')->nullable();
            $table->text('contact_name')->nullable();
            $table->text('contact_number')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('contact_email')->nullable();
            $table->text('delivery_method')->nullable();
            $table->text('emirate')->nullable();
            $table->text('country')->nullable();
            $table->text('address')->nullable();

            $table->text('sqr_card_username')->nullable();
            $table->text('sqr_card_password')->nullable();

            $table->text('card_collected')->nullable();
            $table->text('delivery_reference')->nullable();
            $table->boolean('is_api')->default(false);
            $table->json('inventory_used')->nullable();
            $table->text('qa_comment')->nullable();
            foreach (Stage::LIST as $stage) {
                $table->dateTime('start-stage-' . $stage['key'])->nullable();
                $table->dateTime('update-stage-' . $stage['key'])->nullable();
                $table->boolean('expired-notify-stage-' . $stage['key'])->default(false);
            }

            $table->boolean('aramex_submitted')->default(false);
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
