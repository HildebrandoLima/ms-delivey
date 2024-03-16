<?php

namespace Database\Factories;

use App\Domains\Models\Pedido;
use App\Domains\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Models\Model>
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
            'nome' => Str::random(30),
            'preco' => 15.30,
            'quantidade_item' => 1,
            'sub_total' => 15.30,
            'pedido_id' => Pedido::factory()->createOne()->id,
            'produto_id' => Produto::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
