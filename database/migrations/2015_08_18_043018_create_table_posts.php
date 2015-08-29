<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->tinyInteger('type')->default(1);
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->string('slug');
            $table->string('summary');
            $table->text('embed')->nullable();
            $table->text('content');
            $table->integer('views')->unsigned();
            $table->integer('likes')->unsigned();
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::table("posts", function (Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
        });
        Schema::drop('posts');
    }
}
