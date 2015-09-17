<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('post_id')->nullable();
            $table->string('file_path');
            $table->string('file_name');
            $table->bigInteger('file_size');
            $table->string('caption')->nullable();
            $table->text('description')->nullable();
            $table->string('type');
            $table->softDeletes();
            $table->timestamps();
            $table->index('post_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('medias');
    }
}
