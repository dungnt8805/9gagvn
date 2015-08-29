<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategoriesPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('category_post', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('category_post', function(Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('category_post', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
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
        Schema::drop('category_post');
    }
}
