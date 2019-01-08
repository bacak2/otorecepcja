<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartament_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apartament_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('apartament_name','200');
            $table->string('apartament_link','300');
            $table->longtext('apartament_description');
            $table->timestamps();
        //    $table->foreign('apartament_id')->references('id')->on('apartaments');
        //    $table->foreign('language_id')->references('id')->on('languages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartament_descriptions');
    }
}
