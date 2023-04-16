<?php

namespace Tests\Feature\Address;

use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_create_a_successful_response(): void
    {
        //$address = Endereco::factory(2)->create()->toArray();
        $address = [
            'logradouro' => 'Rua',
            'descricao' => 'Teste, N°10',
            'bairro' => 'Messejana',
            'cidade' => 'Fortaleza',
            'cep' => rand(1000, 9000),
            'uf_id' => 1,
            'usuario_id' => 1,
            'fornecedor_id' => 1,
        ];
        $response = $this->postJson('/api/address/save', $address);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_a_failure_response(): void
    {
        $address = [
            'logradouro' => 'Rua',
            'descricao' => 'Teste, N°10',
            'bairro' => 'Messejana',
            'cidade' => 'Fortaleza',
            'cep' => rand(1000, 9000),
            'uf_id' => 1,
            'usuario_id' => 1,
            'fornecedor_id' => 1,
        ];
        $response = $this->postJson('/api/address/save', $address);
        $response->assertStatus(404);
    }
}
