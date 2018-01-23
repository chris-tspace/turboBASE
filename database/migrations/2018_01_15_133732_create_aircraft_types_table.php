<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAircraftTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircraft_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('left_engine_type_id')->nullable();
            $table->integer('right_engine_type_id')->nullable();
            $table->integer('front_engine_type_id')->nullable();
            $table->integer('rear_engine_type_id')->nullable();
            $table->integer('middle_engine_type_id')->nullable();
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
        Schema::dropIfExists('aircraft_types');
    }
}
