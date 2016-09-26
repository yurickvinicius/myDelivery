<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlavorImagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('flavor_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flavor_id')->unsigned();
            $table->foreign('flavor_id')->references('id')->on('flavors')->onDelete('cascade');
            $table->string('extension', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('flavor_images');
    }

}
