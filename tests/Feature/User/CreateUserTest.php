<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_create_a_successful_response(): void
    {
        //$user = User::factory(1)->create()->toArray();
        $user = [
            'name' => 'Teste',
            'cpf' => rand(1000, 10000),
            'email' => 'email@email.com.br',
            'password' => Hash::make('Teste#421A'),
            'data_nascimento' => new \dateTime(),
            'genero' => 'Masculino',
            'ativo' => '1',
        ];
        $response = $this->postJson('/api/user/save', $user);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_a_failure_response(): void
    {
        $user = [
            'name' => 'Teste',
            'cpf' => rand(1000, 10000),
            'email' => 'email@email.com.br',
            'password' => Hash::make('Teste#421A'),
            'data_nascimento' => new \dateTime(),
            'genero' => ''
        ];
        $response = $this->postJson('/api/user/save', $user);
        $response->assertStatus(404);
    }
}
