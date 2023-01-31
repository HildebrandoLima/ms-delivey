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
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50)->notnull();
            $table->decimal('preco_custo', 10, 2)->notnull();
            $table->decimal('margem_lucro', 10, 2)->notnull();
            $table->decimal('preco_venda', 10, 2)->notnull();
            $table->string('codigo_barra', 13)->notnull();
            $table->string('descricao', 100)->notnull();
            $table->string('quantidade')->notnull();
            $table->enum('unidade_medida', ['UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX']);
            $table->enum('ativo', [0, 1]);
            $table->timestamp('data_validade')->notnull();
            $table->foreignId('fornecedores_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('produto');
    }
};
