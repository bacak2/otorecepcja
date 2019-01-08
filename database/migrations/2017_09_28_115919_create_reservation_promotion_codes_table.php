<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationPromotionCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_promotion_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('promotion_code_name');
            $table->float('promotion_code_value');
            $table->string('promotion_code_code');
            $table->longtext('promotion_code_description');
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
        Schema::dropIfExists('reservation_promotion_codes');
    }
}
