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
            $table->id();
            $table->string('numero', 9)->notnull();
            $table->enum('tipo', ['Fixo', 'Celular']);
            $table->foreignId('ddd_id')->constrained('ddd');
            $table->foreignId('users_id')->nullable()->constrained('users');
            $table->foreignId('fornecedores_id')->nullable()->constrained('fornecedores');
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
