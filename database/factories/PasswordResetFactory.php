<?php

namespace Database\Factories;

use App\Domains\Models\MetodoPagamento;
use App\Domains\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Models\Pagamento>
 */
class PasswordResetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' =>$this->faker->email,
            'token' => Str::uuid(),
            'codigo' => Str::random(10),
        ];
    }
}
