<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAircraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircrafts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aircraft_type_id');
            $table->string('serial_number');
            $table->string('manufacturer_code')->nullable();
            $table->integer('engine1_id')->nullable();
            $table->integer('engine2_id')->nullable();
            $table->integer('engine3_id')->nullable();
            $table->integer('engine4_id')->nullable();
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
        Schema::dropIfExists('aircrafts');
    }
}