<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizePizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_pizzas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('size');
            $table->integer('parts');
            $table->decimal('price');
            $table->integer('pieces');
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
        Schema::drop('size_pizzas');
    }
}
