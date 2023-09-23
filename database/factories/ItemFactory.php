<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantidade_item' => rand(1, 3),
            'sub_total' => 20.5,
            'pedido_id' => Pedido::factory()->createOne()->id,
            'produto_id' => Produto::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
