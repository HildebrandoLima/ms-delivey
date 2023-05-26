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
            'numeroPedido' => rand(9, 9),
            'quantidadeItem' => rand(10, 10),
            'total' => 50.99,
            'entrega' => 4.5,
            'ativo' => rand(0, 1),
            'usuarioId' => User::factory()->createOne()->id,
        ];
    }
}
