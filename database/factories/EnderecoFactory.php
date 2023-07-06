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
        $public_place = array('Rua', 'Avenida');
        $rand_keys = array_rand($public_place);
        return [
            'logradouro' => $public_place[$rand_keys],
            'descricao' => $this->faker->numerify,
            'bairro' => $this->faker->country,
            'cidade' => $this->faker->city,
            'cep' => rand(10000000, 20000000),
            'uf_id' => rand(1, 27),
            'usuario_id' => User::factory()->createOne()->id,
            'fornecedor_id' => Fornecedor::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
