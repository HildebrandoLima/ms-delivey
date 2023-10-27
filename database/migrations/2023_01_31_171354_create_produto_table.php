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
            $table->id()->autoIncrement();
            $table->string('nome', 100)->unique()->notnull();
            $table->decimal('preco_custo', 10, 2)->notnull();
            $table->decimal('margem_lucro', 10, 2)->notnull();
            $table->decimal('preco_venda', 10, 2)->notnull();
            $table->char('codigo_barra', 13)->unique()->notnull();
            $table->string('descricao', 255)->notnull();
            $table->integer('quantidade')->notnull();
            $table->enum('unidade_medida', ['UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX']);
            $table->timestamp('data_validade')->notnull();
            $table->foreignId('fornecedor_id')->constrained('fornecedor')->notnull();
            $table->foreignId('categoria_id')->constrained('categoria')->notnull();
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
        Schema::dropIfExists('produto');
    }
};
