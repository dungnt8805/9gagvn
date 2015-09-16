<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 30)->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('role_id')->unsigned();
            $table->boolean('activated')->default(false);
            $table->string('activation_code', 255)->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('last_login');
            $table->string('name', 50)->nullable();
            $table->boolean('gender')->default(true);
            $table->string('birth_day',2)->nullable();
            $table->string('birth_month',2)->nullable();
            $table->string('birth_year',4)->nullable();
            $table->string('fb_user')->nullable();
            $table->string('fb_id')->nullable();
            $table->string('fb_link')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
