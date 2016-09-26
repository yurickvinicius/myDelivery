<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cep', 30);
            $table->string('state', 30);
            $table->string('city', 50);
            $table->string('neighborhood', 70);
            $table->text('address');
            $table->integer('number');
            $table->text('complement');
            $table->string('phone', 20);
            $table->string('cell_phone', 20);

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('clients');
    }

}
