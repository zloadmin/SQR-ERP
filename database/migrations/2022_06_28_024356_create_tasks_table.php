<?php

use App\Models\Stage;
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
            $table->uuid('uuid');
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')->on('stages')->references('id');
            $table->string('name')->default('');
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

            $table->string('sqr_card_username')->default('');
            $table->string('sqr_card_password')->default('');

            $table->string('card_collected')->default('');
            $table->string('delivery_reference')->default('');
            $table->boolean('is_api')->default(false);
            foreach (Stage::LIST as $stage) {
                $table->dateTime('start-stage-' . $stage['key'])->nullable();
                $table->boolean('expired-notify-stage-' . $stage['key'])->default(false);
            }

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
