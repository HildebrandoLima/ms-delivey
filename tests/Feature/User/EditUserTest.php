<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_update_a_successful_response(): void
    {
        $user = [
            'usuarioId'=> 1,
            'nome' => 'Teste Teste44',
            'cpf' => '12255678988',
            'email'=> 'teste00@email.com',
            'senha' => Hash::make('Teste#421A'),
            'dataNascimento' => '2023-03-25 18:20:59',
            'genero' => 'Feminino',
            'ativo' => '1',
        ];
        $response = $this->putJson('/api/user/edit', $user);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_a_failure_response(): void
    {
        $user = [
            'usuarioId'=> 1000,
            'nome' => 'Teste Teste44',
            'cpf' => '12255678988',
            'email'=> 'teste00@email.com',
            'senha' => Hash::make('Teste#421A'),
            'dataNascimento' => '2023-03-25 18:20:59',
            'genero' => 'Feminino',
            'ativo' => '1',
        ];
        $response = $this->putJson('/api/user/edit', $user);
        $response->assertStatus(204);
    }
}
