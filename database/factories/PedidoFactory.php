<?php

namespace Database\Factories;

use App\Domains\Models\Endereco;
use App\Domains\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $typeDelivery = array('Expresso', 'Correio', 'Retirada');
        $randKeys = array_rand($typeDelivery);
        return [
            'numero_pedido' => random_int(100000000, 999999999),
            'quantidade_item' => rand(10, 10),
            'total' => 50.99,
            'tipo_entrega' => $typeDelivery[$randKeys],
            'valor_entrega' => 4.5,
            'usuario_id' => User::factory()->createOne()->id,
            'endereco_id' => Endereco::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
