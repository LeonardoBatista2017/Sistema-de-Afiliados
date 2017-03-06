<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostContadorCodigoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_contador_codigo', function (Blueprint $table) {
            $table->increments('id');
             $table->string('contador')->nullable();
            $table->integer('contador_id')->unsigned();
            $table->foreign('contador_id')->references('id')->on('contador_registro')->onDelete('cascade');
            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
