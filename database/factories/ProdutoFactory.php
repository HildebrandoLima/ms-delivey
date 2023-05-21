<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
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
            'preco_custo' => 15.30,
            'margem_lucro' => 4.7,
            'preco_venda' => 20.0,
            'codigo_barra' => Str::random(13),
            'descricao' => $this->faker->sentence,
            'quantidade' => rand(10, 50),
            'unidade_medida' => array_rand($unidadeMedida),
            'ativo' => rand(0, 1),
            'data_validade' => $this->faker->dateTime,
            'fornecedor_id' => Fornecedor::factory()->createOne()->id,
        ];
    }
}
