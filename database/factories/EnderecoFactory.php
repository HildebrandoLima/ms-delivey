<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
            'logradouro' => 'Rua',
            'descricao' => 'sdsdsd',
            'bairro' => 'asdsd',
            'cidade' => $this->faker->country,
            'cep' => rand(1000, 9000),
            'uf_id' => 1,
            'usuario_id' => 1,
            'fornecedor_id' => 1,
        ];
    }
}
