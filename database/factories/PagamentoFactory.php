<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $typeCard = array('Crédito', 'Débito');
        $randKeysCard = array_rand($typeCard);
        $typePayment = array('Boleto Bancário', 'Crédito', 'Débito', 'Pix');
        $randKeysPayment = array_rand($typePayment);
        return [
            'codigo_transacao' => rand(1, 1000),
            'numero_cartao' => rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200),
            'tipo_cartao' => $typeCard[$randKeysCard],
            'ccv' => rand(100, 100),
            'data_validade' => $this->faker->dateTime,
            'parcela' => rand(1, 3),
            'total' => 20.0,
            'metodo_pagamento_id' => $typePayment[$randKeysPayment],
            'pedido_id' => Pedido::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
