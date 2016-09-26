<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlavorsPizzasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('flavors_pizzas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pizza_built_id')->unsigned();
            $table->foreign('pizza_built_id')->references('id')->on('pizza_builts');

            $table->integer('flavor_id')->unsigned();
            $table->foreign('flavor_id')->references('id')->on('flavors');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('flavors_pizzas');
    }

}
