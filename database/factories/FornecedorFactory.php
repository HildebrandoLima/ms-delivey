<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedor>
 */
class FornecedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'cnpj' => Str::random(14),
            'email' => $this->faker->email,
            'ativo' => rand(0, 1),
            'data_fundacao' => $this->faker->dateTime(),
        ];
    }
}
