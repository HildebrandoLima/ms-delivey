<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50)->notnull()->unique();
            $table->string('cpf', 11)->notnull()->unique();
            $table->string('email', 50)->notnull()->unique();
            $table->timestamp('data_mascimento')->notnull();
            $table->enum('genero', ['Masculino', 'Feminino', 'Outro']);
            $table->enum('ativo', [0, 1]);
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
        Schema::dropIfExists('users');
    }
};
