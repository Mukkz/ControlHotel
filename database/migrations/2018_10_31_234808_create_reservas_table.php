<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('inicioReserva');
            $table->date('fimReserva');
            $table->integer('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->integer('hospede_id');
            $table->foreign('hospede_id')->references('id')->on('hospedes');
            $table->integer('quarto_id');
            $table->foreign('quarto_id')->references('id')->on('quartos');
            $table->double('valorDiaria');
            $table->String('efetuouReserva');
            $table->String('status')->default('aberto');
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
        Schema::dropIfExists('reservas');
    }
}
