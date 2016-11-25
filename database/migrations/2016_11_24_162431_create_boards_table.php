<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('boards', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name', 60);
      $table->integer('number');
      $table->timestamps();
    });

    Schema::table('orders', function (Blueprint $table) {
      $table->integer('board_id')->unsigned()->nullable();
      $table->foreign('board_id')->references('id')->on('boards');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::table('orders', function(Blueprint $table) {
        $table->dropForeign('orders_board_id_foreign');
        $table->dropColumn('board_id');
    });
    Schema::drop('boards');
  }
}
