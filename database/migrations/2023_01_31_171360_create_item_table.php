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
            $table->integer('quantidade_item')->notnull();
            $table->decimal('sub_total', 10, 2)->notnull();
            $table->foreignId('pedido_id')->constrained('pedido')->notnull();
            $table->foreignId('produto_id')->constrained('produto')->notnull();
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
        Schema::dropIfExists('item');
    }
};
