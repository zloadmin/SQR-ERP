<?php

use App\Models\EmailAlert;
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
        Schema::create('email_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', EmailAlert::TYPES);
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')->on('stages')->references('id');
            $table->unsignedBigInteger('recipient_id');
            $table->string('subject');
            $table->text('text');
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
        Schema::dropIfExists('email_alerts');
    }
};
