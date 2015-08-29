<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePostsTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('post_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('post_tag', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('post_tag', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::drop('post_tag');
    }
}
