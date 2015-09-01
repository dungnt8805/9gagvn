<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("stores",function(Blueprint $table){
           $table->increments('id');
           $table->string('title');
           $table->string('slug')->unique();
           $table->text('address');
           $table->text('description');
           $table->string('thumbnail');
           $table->string('link');
           $table->integer('coupons')->unsigned()->default(0);
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
        Schema::drop('stores');
    }
}
