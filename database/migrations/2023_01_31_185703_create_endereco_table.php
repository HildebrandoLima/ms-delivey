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
        Schema::create('endereco', function (Blueprint $table) {
            $table->id();
            $table->enum('logradouro', ['Rua', 'Av']);
            $table->string('descricao')->notnull();
            $table->string('bairro')->notnull();
            $table->string('cidade')->notnull();
            $table->string('cep', 7)->notnull();
            $table->foreignId('unidade_federativa_id')->constrained('unidade_federativa');
            $table->foreignId('users_id')->constrained('users')->nullable()->onDelete('cascade');
            $table->foreignId('fornecedores_id')->constrained('fornecedores')->nullable()->onDelete('cascade');
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
        Schema::dropIfExists('endereco');
    }
};
