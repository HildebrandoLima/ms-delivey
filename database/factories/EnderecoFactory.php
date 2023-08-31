<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'logradouro' => Str::random(20),
            'numero' => $this->faker->numerify,
            'bairro' => $this->faker->country,
            'cidade' => $this->faker->city,
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'uf' => 'CE',
            'usuario_id' => User::factory()->createOne()->id,
            'fornecedor_id' => Fornecedor::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
