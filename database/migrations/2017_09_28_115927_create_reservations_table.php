<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apartament_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('reservation_arrive_date');
            $table->date('reservation_departure_date');
            $table->integer('reservation_persons');
            $table->integer('reservation_kids');
            $table->integer('reservation_status');
         //   $table->foreign('user_id')->references('id')->on('users');
         //   $table->foreign('apartament_id')->references('id')->on('apartaments');
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
        Schema::dropIfExists('reservations');
    }
}
