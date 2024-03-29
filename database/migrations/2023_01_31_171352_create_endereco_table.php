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
            $table->string('logradouro', 50)->notnull();
            $table->integer('numero')->notnull();
            $table->string('bairro', 50)->notnull();
            $table->string('cidade', 50)->notnull();
            $table->char('cep', 9)->notnull();
            $table->char('uf', 2)->notnull();
            $table->foreignId('usuario_id')->nullable()->default(NULL)->constrained('users');
            $table->foreignId('fornecedor_id')->nullable()->default(NULL)->constrained('fornecedor');
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
