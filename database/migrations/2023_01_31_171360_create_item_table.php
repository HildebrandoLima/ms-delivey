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
        Schema::create('item', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nome', 50)->notnull();
            $table->decimal('preco', 10, 2)->notnull();
            $table->char('codigo_barra', 13)->notnull();
            $table->integer('quantidade_item')->notnull();
            $table->decimal('sub_total', 10, 2)->notnull();
            $table->enum('unidade_medida', ['UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX']);
            $table->foreignId('pedido_id')->constrained('pedido');
            $table->foreignId('produto_id')->constrained('produto');
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
        Schema::dropIfExists('item');
    }
};
