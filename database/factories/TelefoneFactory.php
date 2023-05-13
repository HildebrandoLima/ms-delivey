<?php

namespace Database\Factories;

use App\Models\DDD;
use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $tipo = array('Fixo', 'Celular');
        return [
            'numero' => Str::ramdon(9),
            'tipo' => array_rand($tipo),
            'ddd_id' => DDD::factory()->createOne()->id,
            'usuario_id' => User::factory()->createOne()->id,
            'fornecedor_id' => Fornecedor::factory()->createOne()->id,
            'ativo' => rand(0, 1)
        ];
    }
}
