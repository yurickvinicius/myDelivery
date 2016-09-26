<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPizzasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('order_pizzas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pizza_built_id')->unsigned();
            $table->foreign('pizza_built_id')->references('id')->on('pizza_builts');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('order_pizzas');
    }

}
