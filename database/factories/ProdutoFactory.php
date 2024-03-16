<?php

namespace Database\Factories;

use App\Domains\Models\Categoria;
use App\Domains\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Models\Produto>
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
        $unitMeasure = array('UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX');
        $randKeys = array_rand($unitMeasure);
        return [
            'nome' => Str::random(30),
            'preco_custo' => 15.30,
            'margem_lucro' => 4.7,
            'preco_venda' => 20.0,
            'codigo_barra' => Str::random(13),
            'descricao' => $this->faker->sentence,
            'quantidade' => rand(10, 50),
            'unidade_medida' => $unitMeasure[$randKeys],
            'data_validade' => $this->faker->dateTime,
            'categoria_id' => Categoria::factory()->createOne()->id,
            'fornecedor_id' => Fornecedor::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
