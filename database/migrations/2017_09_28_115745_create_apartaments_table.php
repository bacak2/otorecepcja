<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartaments', function (Blueprint $table) {
            $table->increments('id');
            $table->double('apartament_geo_lat','10','6');
            $table->double('apartament_geo_lan','10','6');
            $table->string('apartament_address','200');
            $table->string('apartament_address_2','200');
            $table->string('apartament_city','200');
            $table->integer('apartament_persons');
            $table->integer('apartament_rooms_number');
            $table->integer('apartament_single_beds');
            $table->integer('apartament_double_beds');
            $table->integer('apartament_living_area');
            $table->integer('apartament_floors_number');
            $table->boolean('apartament_animals');
            $table->boolean('apartament_wifi');
            $table->boolean('apartament_parking');
            $table->boolean('apartament_elevator');
            $table->string('apartament_registration_time','200');
            $table->string('apartament_checkout_time','200');
            $table->integer('apartament_default_photo_id');
            $table->integer('group_id')->unsigned();
            $table->integer('owner_id')->unsigned();
        //    $table->foreign('group_id')->references('id')->on('apartament_groups');
        //    $table->foreign('owner_id')->references('id')->on('owners');
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
        Schema::dropIfExists('apartaments');
    }
}
