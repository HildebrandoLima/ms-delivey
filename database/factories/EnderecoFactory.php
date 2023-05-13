<?php

namespace Database\Factories;

use App\Models\DDD;
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
        $logradouro = array('Rua', 'Av');
        return [
            'logradouro' => array_rand($logradouro),
            'descricao' => $this->faker->numerify,
            'bairro' => $this->faker->country,
            'cidade' => $this->faker->city,
            'cep' => Str::random(7),
            'uf_id' => DDD::factory()->createOne()->id,
            'usuario_id' => User::factory()->createOne()->id,
            'fornecedor_id' => Fornecedor::factory()->createOne()->id,
        ];
    }
}
