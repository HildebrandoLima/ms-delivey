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
            $table->id()->autoIncrement();
            $table->string('name', 50)->unique()->notnull();
            $table->string('cpf', 11)->unique()->notnull();
            $table->string('email', 50)->unique()->notnull();
            $table->string('password', 100)->unique()->notnull();
            $table->timestamp('data_nascimento')->notnull();
            $table->enum('genero', ['Masculino', 'Feminino', 'Outro']);
            $table->boolean('ativo');
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
