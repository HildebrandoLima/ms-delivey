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
            $table->integer('tipo_transacao')->notnull();
            $table->char('numero_cartao', 16)->unique()->notnull();
            $table->date('data_credito')->notnull();
            $table->integer('parcela')->notnull();
            $table->decimal('total', 10, 2)->notnull();
            $table->boolean('ativo');
            $table->foreignId('metodo_pagamento_id')->constrained('metodo_pagamento');
            $table->foreignId('imp_id')->constrained('identificador_metodo_pagamento');
            $table->foreignId('pedido_id')->constrained('pedido');
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
