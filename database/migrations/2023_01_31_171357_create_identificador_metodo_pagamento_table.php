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
        Schema::create('identificador_metodo_pagamento', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('descricao', 20)->unique()->notnull();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identificador_metodo_pagamento');
    }
};
