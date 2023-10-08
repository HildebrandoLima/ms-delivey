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
            $table->char('numero_cartao', 19)->nullable()->default(NULL);
            $table->enum('tipo_cartao', ['Crédito', 'Débito']);
            $table->char('ccv', 3)->nullable()->default(NULL);
            $table->date('data_validade')->nullable()->default(NULL);
            $table->integer('parcela')->nullable()->default(NULL);
            $table->decimal('total', 10, 2)->notnull();
            $table->enum('metodo_pagamento', ['Boleto Bancário', 'Crédito', 'Débito', 'Pix']);
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
