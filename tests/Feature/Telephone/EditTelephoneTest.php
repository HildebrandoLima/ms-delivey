<?php

namespace Tests\Feature\Telephone;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_create_a_successful_response(): void
    {
        $telephone = [
            'telefoneId'=> 2,
            'numero' => rand(100, 900),
            'tipo' => 'Celular',
            'ddd_id' => 1,
            'usuario_id' => 1,
            'fornecedor_id' => 1,
        ];
        $response = $this->putJson('/api/telephone/edit', $telephone);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_create_a_failure_response(): void
    {
        $telephone = [
            'telefoneId'=> 2,
            'numero' => '',
            'tipo' => 'Celular',
            'ddd_id' => 1,
            'usuario_id' => 1,
            'fornecedor_id' => 1,
        ];
        $response = $this->putJson('/api/telephone/edit', $telephone);
        $response->assertStatus(422);
    }
}
