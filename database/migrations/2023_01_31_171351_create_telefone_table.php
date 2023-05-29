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
        Schema::create('telefone', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->char('numero', 9)->unique()->notnull();
            $table->enum('tipo', ['Fixo', 'Celular']);
            $table->foreignId('ddd_id')->constrained('ddd')->notnull();
            $table->foreignId('usuario_id')->constrained('users')->nullable(false)->change();
            $table->foreignId('fornecedor_id')->constrained('fornecedor')->nullable(false)->change();
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
        Schema::dropIfExists('telefone');
    }
};
