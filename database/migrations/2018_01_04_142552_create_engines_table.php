<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnginesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engines', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->increments('id');
            $table->integer('engine_type_id');
            $table->string('serial_number');
            $table->string('identification');
            $table->integer('aircraft_id')->nullable();
            $table->integer('aircraft_position')->nullable(); // 1:left, 2:right, 3:front, 4:rear, 5:middle
            $table->dateTime('date')->nullable(); // install or removal date
            $table->integer('action_post_id')->nullable(); // install or removal post id
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
        Schema::dropIfExists('engines');
    }
}
