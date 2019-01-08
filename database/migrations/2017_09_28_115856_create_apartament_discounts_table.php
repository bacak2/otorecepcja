<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartament_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apartament_id')->unsigned();
            $table->string('discount_name');
            $table->float('discount_value');
            $table->integer('discount_days_counter');
           // $table->foreign('apartament_id')->references('id')->on('apartaments');
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
        Schema::dropIfExists('apartament_discounts');
    }
}
