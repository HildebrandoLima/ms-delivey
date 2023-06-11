<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $genero = array('Masculino' => 'Masculino', 'Feminino' => 'Feminino', 'Outro' => 'Outro');
        return [
            'provider_id' => null,
            'provider' => null,
            'name' => $this->faker->name,
            'cpf' => Str::random(11),
            'email' => $this->faker->email,
            'password' => Hash::make($this->faker->password),
            'data_nascimento' => $this->faker->dateTime,
            'genero' => array_rand($genero),
            'perfil_id' => rand(1, 2),
            'ativo' => true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
