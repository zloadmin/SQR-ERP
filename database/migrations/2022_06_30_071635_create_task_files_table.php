<?php

use App\Models\TaskFile;
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
        Schema::create('task_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')->on('tasks')->references('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id');
            $table->string('path');
            $table->string('original_name');
            $table->unsignedBigInteger('size');
            $table->enum('type', TaskFile::TYPES);
            $table->boolean('approved')->nullable();
            $table->text('approved_comment')->nullable();
            $table->unsignedBigInteger('approved_user_id')->nullable();
            $table->foreign('approved_user_id')->on('users')->references('id');
            $table->boolean('is_aramex')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('task_files');
    }
};
