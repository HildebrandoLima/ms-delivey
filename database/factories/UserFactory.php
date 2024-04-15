<?php

namespace Database\Factories;

use App\Domains\Traits\GenerateData\GenerateCPF;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    use GenerateCPF;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = array('Masculino', 'Feminino', 'Outro');
        $randKeys = array_rand($gender);
        return [
            'nome' => $this->faker->name,
            'cpf' => $this->generateCPF(),
            'email' => $this->faker->email,
            'password' => Hash::make($this->faker->password),
            'data_nascimento' => $this->faker->dateTime,
            'genero' => $gender[$randKeys],
            'e_admin' => rand(0, 1),
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
            'email_verificado' => null,
        ]);
    }
}
