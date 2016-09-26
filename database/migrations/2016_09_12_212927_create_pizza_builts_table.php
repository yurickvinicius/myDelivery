<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePizzaBuiltsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pizza_builts', function (Blueprint $table) {
            $table->increments('id');
            ///$table->integer('parts');
            $table->text('observation');
            
            $table->integer('edge_pizza_id')->unsigned();
            $table->foreign('edge_pizza_id')->references('id')->on('edge_pizzas');
            
            $table->integer('size_pizza_id')->unsigned();
            $table->foreign('size_pizza_id')->references('id')->on('size_pizzas');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('pizza_builts');
    }

}
