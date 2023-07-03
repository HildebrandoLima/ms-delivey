<?php

namespace Database\Factories;

use App\Support\Generate\GenerateCNPJ;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'razao_social' => $this->faker->name,
            'cnpj' => str_replace(array('.','-','/'), "", GenerateCNPJ::generateCNPJ()),
            'email' => $this->faker->email,
            'data_fundacao' => $this->faker->dateTime,
            'ativo' => true,
        ];
    }
}
