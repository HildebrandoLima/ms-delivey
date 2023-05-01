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
            $table->id()->autoIncrement();
            $table->enum('logradouro', ['Rua', 'Av']);
            $table->string('descricao', 50)->notnull();
            $table->string('bairro', 50)->notnull();
            $table->string('cidade', 50)->notnull();
            $table->char('cep', 7)->notnull();
            $table->foreignId('uf_id')->constrained('unidade_federativa');
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('fornecedor_id')->constrained('fornecedor');
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
        Schema::dropIfExists('endereco');
    }
};
