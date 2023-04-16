<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Telefone>
 */
class TelefoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'numero' => rand(100, 900),
            'tipo' => 'Fixo',
            'ddd_id' => 1,
            'usuario_id' => 1,
            'fornecedor_id' => 1,
        ];
    }
}
