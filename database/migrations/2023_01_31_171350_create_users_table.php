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
            $table->integer('login_social_id')->nullable()->default(NULL);
            $table->string('login_social', 30)->nullable()->default(NULL);
            $table->string('nome', 50)->unique()->notnull();
            $table->string('cpf', 14)->unique()->nullable()->default(NULL);
            $table->string('email', 50)->unique()->notnull();
            $table->string('password', 100)->unique()->nullable()->default(NULL);
            $table->rememberToken();
            $table->timestamp('data_nascimento')->nullable()->default(NULL);
            $table->enum('genero', ['Masculino', 'Feminino', 'Outro']);
            $table->boolean('email_verificado')->nullable()->default(NULL);
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
