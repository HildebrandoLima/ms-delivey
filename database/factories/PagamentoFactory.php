<?php

namespace Database\Factories;

use App\Models\MetodoPagamento;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pagamento>
 */
class PagamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo_transacao' => rand(1, 10),
            'numero_cartao' => Str::random(),
            'data_validade' => $this->faker->dateTime,
            'parcela' => rand(1, 3),
            'total' => 20.0,
            'ativo' => rand(0, 1),
            'metodo_pagamento_id' => MetodoPagamento::factory()->createOne()->id,
            'pedido_id' => Pedido::factory()->createOne()->id,
        ];
    }
}
