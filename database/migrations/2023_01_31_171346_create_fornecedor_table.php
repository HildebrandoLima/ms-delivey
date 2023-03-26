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
        Schema::create('fornecedor', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nome', 50)->unique()->notnull();
            $table->string('cnpj', 14)->unique()->notnull();
            $table->string('email', 50)->unique()->notnull();
            $table->boolean('ativo');
            $table->timestamp('data_fundacao')->notnull();
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
        Schema::dropIfExists('fornecedor');
    }
};