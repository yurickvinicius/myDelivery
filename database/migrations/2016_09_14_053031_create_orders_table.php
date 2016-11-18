<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total');
            $table->string('status');
            $table->string('type_order');
            $table->char('in_use')->default('y');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('delivery_mean_id')->unsigned();
            $table->foreign('delivery_mean_id')->references('id')->on('delivery_means');

            $table->integer('payment_form_id')->unsigned();
            $table->foreign('payment_form_id')->references('id')->on('payment_forms');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('orders');
    }

}
