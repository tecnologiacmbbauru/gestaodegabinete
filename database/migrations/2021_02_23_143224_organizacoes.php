<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Organizacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizacoes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('domain')->unique();
            $table->string('bd_database')->unique(); //caso queira mudar para o futuro poder trabalhar em cameras pequenas com uma databse para multiplos clientes alterar
            $table->string('bd_port');
            $table->string('bd_hostname');
            $table->string('bd_username');
            $table->string('bd_password')->nullable();
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
        Schema::dropIfExists('organizacoes');
    }
}
