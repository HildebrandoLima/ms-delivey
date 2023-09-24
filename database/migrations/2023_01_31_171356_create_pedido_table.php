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
        Schema::create('pedido', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('numero_pedido')->unique()->notnull();
            $table->integer('quantidade_item')->notnull();
            $table->decimal('total', 10, 2)->notnull();
            $table->enum('tipo_entrega', ['Expresso', 'Correio', 'Retirada']);
            $table->decimal('valor_entrega', 10, 2)->notnull();
            $table->foreignId('usuario_id')->constrained('users')->notnull();
            $table->foreignId('endereco_id')->constrained('endereco')->notnull();
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
        Schema::dropIfExists('pedido');
    }
};
