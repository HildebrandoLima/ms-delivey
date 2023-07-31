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
            $table->string('nome', 50)->unique()->notnull();
            $table->string('cpf', 11)->unique()->notnull();
            $table->string('email', 50)->unique()->notnull();
            $table->string('password', 100)->unique()->notnull();
            $table->timestamp('data_nascimento')->notnull();
            $table->enum('genero', ['Masculino', 'Feminino', 'Outro']);
            $table->timestamp('email_verified_at')->nullable()->default(NULL);
            $table->rememberToken();
            $table->boolean('e_admin');
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
