<?php

namespace Database\Factories;

use App\Domains\Traits\GenerateData\GenerateCNPJ;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedor>
 */
class FornecedorFactory extends Factory
{
    use GenerateCNPJ;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'razao_social' => $this->faker->name,
            'cnpj' => $this->generateCNPJ(),
            'email' => $this->faker->email,
            'data_fundacao' => $this->faker->dateTime,
            'ativo' => true,
        ];
    }
}
