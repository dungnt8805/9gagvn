<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('comments',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->text('content');
            $table->integer('likes')->unsigned()->default(0);
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
            $table->dropForeign('comments_post_id_foreign');
        });
        Schema::drop('comments');
    }
}
