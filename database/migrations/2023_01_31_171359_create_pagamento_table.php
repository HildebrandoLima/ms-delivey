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
        Schema::create('pagamento', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('codigo_transacao')->unique()->notnull();
            $table->char('numero_cartao', 16);
            $table->date('data_validade');
            $table->integer('parcela');
            $table->decimal('total', 10, 2)->notnull();
            $table->foreignId('metodo_pagamento_id')->constrained('metodo_pagamento')->notnull();
            $table->foreignId('pedido_id')->constrained('pedido')->notnull();
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
        Schema::dropIfExists('pagamento');
    }
};
