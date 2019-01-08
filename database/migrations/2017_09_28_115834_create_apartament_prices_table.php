<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartament_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apartament_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->float('price_value');
            $table->date('date_of_price');
            $table->float('price_discount');
            $table->timestamps();
          //  $table->foreign('apartament_id')->references('id')->on('apartaments');
          //  $table->foreign('language_id')->references('id')->on('languages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartament_prices');
    }
}
