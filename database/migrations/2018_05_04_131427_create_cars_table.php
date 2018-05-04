<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('make');
            $table->string('name');
            $table->string('category');
            $table->double('speed');
            $table->double('acceleration');
            $table->double('braking');
            $table->double('cornering');
            $table->double('stability');
            $table->integer('power');
            $table->integer('price');
            $table->string('drive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
