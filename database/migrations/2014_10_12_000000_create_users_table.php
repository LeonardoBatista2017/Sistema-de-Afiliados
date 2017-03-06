<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image', 200)->nullable();
            $table->string('cpf', 14)->unique()->nullable();
            $table->string('banco', 100)->nullable();
            $table->string('agencia', 50)->nullable();
            $table->string('conta', 50)->nullable();
            $table->string('cep', 50)->nullable();
            $table->string('rua', 200)->nullable();
            $table->string('numero', 100)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('estado', 100)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('telefone', 14)->nullable();
            $table->rememberToken();
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
       
    }
}
