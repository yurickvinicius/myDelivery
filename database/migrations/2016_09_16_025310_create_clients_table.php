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
            $table->string('name', 60)->nullable();
            $table->string('cep', 30)->nullable();
            $table->string('state', 30)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('neighborhood', 70);
            $table->text('address');
            $table->integer('number');
            $table->text('complement')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('cell_phone', 20);

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->integer('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign('orders_client_id_foreign');
            $table->dropColumn('client_id');
        });

        Schema::drop('clients');
    }

}
