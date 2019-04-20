<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status');
            $table->integer('fleet_id');
            $table->integer('car_id');
            $table->integer('driver_id');
            $table->string('departure')->nullable();
            $table->string('destination')->nullable();
            $table->integer('estimated_time')->nullable();
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
        Schema::dropIfExists('messions');
    }
}
