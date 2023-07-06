<?php

namespace Database\Factories;

use App\Support\Generate\GenerateCPF;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
        $gender = array('Masculino', 'Feminino', 'Outro');
        $rand_keys = array_rand($gender);
        return [
            'login_social_id' => null,
            'login_social' => null,
            'name' => $this->faker->name,
            'cpf' => str_replace(array('.','-','/'), "", GenerateCPF::generateCPF()),
            'email' => $this->faker->email,
            'password' => Hash::make($this->faker->password),
            'data_nascimento' => $this->faker->dateTime,
            'genero' => $gender[$rand_keys],
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
