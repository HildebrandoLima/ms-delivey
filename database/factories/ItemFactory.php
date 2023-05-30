<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $unidadeMedida = array('UN' => 'UN', 'G' => 'G', 'KG' => 'KG', 'ML' => 'ML', 'L' => 'L', 'M2' => 'M2', 'CX' => 'CX');
        return [
            'nome' => $this->faker->word,
            'preco' => 15.0,
            'codigo_barra' => Str::random(13),
            'quantidade_item' => rand(1, 3),
            'sub_total' => 20.5,
            'unidade_medida' => array_rand($unidadeMedida),
            'pedido_id' => Pedido::factory()->createOne()->id,
            'produto_id' => Produto::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
