<?php

namespace Tests\Feature\Provider;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_update_a_successful_response(): void
    {
        $provider = [
            'fornecedorId'=> 1,
            'nome' => 'Teste',
            'cnpj' => rand(1000, 10000),
            'email' => 'email@email.com.br',
            'ativo' => '1',
            'data_fundacao' => new \dateTime(),
        ];
        $response = $this->putJson('/api/provider/edit', $provider);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_a_failure_response(): void
    {
        $provider = [
            'fornecedorId'=> 1,
            'nome' => 'Teste',
            'cnpj' => rand(1000, 10000),
            'email' => '',
            'ativo' => '',
            'data_fundacao' => new \dateTime(),
        ];
        $response = $this->putJson('/api/provider/edit', $provider);
        $response->assertStatus(422);
    }
}
