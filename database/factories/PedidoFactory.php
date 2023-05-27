<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        return [
            'numero_pedido' => random_int(100000000, 999999999),
            'quantidade_item' => rand(10, 10),
            'total' => 50.99,
            'entrega' => 4.5,
            'ativo' => true,
            'usuario_id' => User::factory()->createOne()->id,
        ];
    }
}
