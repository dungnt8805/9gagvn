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
            $table->integer('store_id');
            $table->tinyInteger('type')->default(1);
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->string('slug');
            $table->string('summary');
            $table->text('embed')->nullable();
            $table->text('content');
            $table->string('code', 10)->unique();
            $table->integer('views')->unsigned();
            $table->integer('likes')->unsigned();
            $table->integer('dislikes')->default(0)->unsigned();
            $table->integer('comments')->default(0)->unsigned();
            $table->boolean('not_safe_for_work')->default(false);
            $table->string('source')->nullable();
            $table->boolean('active');
            $table->text('start');
            $table->text('expire');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::drop('posts');
    }
}
