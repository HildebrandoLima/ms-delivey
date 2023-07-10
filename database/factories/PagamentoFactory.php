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
            'codigo_transacao' => rand(1, 1000),
            'numero_cartao' => rand(1000000000000000, 9999999999999999),
            'data_validade' => $this->faker->dateTime,
            'parcela' => rand(1, 3),
            'total' => 20.0,
            'metodo_pagamento_id' => rand(1, 6),
            'pedido_id' => Pedido::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
