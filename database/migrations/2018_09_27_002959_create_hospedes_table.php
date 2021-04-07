<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedes', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('hotel_id')->unsigned;
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->string('nome');
            $table->string('email');
            $table->string('contato');
            $table->date('dataNascimento');
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
        Schema::dropIfExists('hospedes');
    }
}
