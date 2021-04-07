<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id')->unique();
            $table->string('nome');
            $table->integer('hotel_id')->unsigned;
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefone');
            $table->string('quartos');
            $table->enum('admin', ['sim', 'não']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
