<?php

namespace Tests\Feature\Address;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditAddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_update_a_successful_response(): void
    {
        $address = [
            'enderecoId'=> 2,
            'logradouro' => 'Rua',
            'descricao' => 'Teste, N°10',
            'bairro' => 'Messejana',
            'cidade' => 'Fortaleza',
            'cep' => rand(1000, 9000),
            'uf_id' => 1,
            'usuario_id' => 2,
            'fornecedor_id' => 2,
        ];
        $response = $this->putJson('/api/address/edit', $address);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_a_failure_response(): void
    {
        $address = [
            'enderecoId'=> 2,
            'logradouro' => 'Rua',
            'descricao' => '',
            'bairro' => 'Messejana',
            'cidade' => 'Fortaleza',
            'cep' => '',
            'uf_id' => 1,
            'usuario_id' => 2,
            'fornecedor_id' => 2,
        ];
        $response = $this->putJson('/api/address/edit', $address);
        $response->assertStatus(422);
    }
}
