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
            $table->string('login_social_id')->unique()->nullable()->default(NULL);
            $table->string('login_social')->unique()->nullable()->default(NULL);
            $table->string('name', 50)->unique()->notnull();
            $table->string('cpf', 11)->unique()->nullable()->default(NULL);
            $table->string('email', 50)->unique()->notnull();
            $table->string('password', 100)->unique()->nullable()->default(NULL);
            $table->timestamp('data_nascimento')->nullable()->default(NULL);
            $table->enum('genero', ['Masculino', 'Feminino', 'Outro']);
            $table->timestamp('email_verified_at')->nullable()->default(NULL);
            $table->rememberToken();
            $table->foreignId('role_id')->nullable()->default(NULL)->constrained('roles');
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
