<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_create_a_successful_response(): void
    {
        //$provider = Fornecedor::factory(1)->create()->toArray();
        $provider = [
            'nome' => 'Teste',
            'cnpj' => rand(1000, 10000),
            'email' => 'email@email.com.br',
            'ativo' => '1',
            'dataFundacao' => new \dateTime(),
        ];
        $response = $this->postJson('/api/provider/save', $provider);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_a_failure_response(): void
    {
        $provider = [
            'nome' => 'Teste',
            'cnpj' => rand(1000, 10000),
            'email' => '',
            'ativo' => '',
            'dataFundacao' => new \dateTime(),
        ];
        $response = $this->postJson('/api/provider/save', $provider);
        $response->assertStatus(404);
    }
}
