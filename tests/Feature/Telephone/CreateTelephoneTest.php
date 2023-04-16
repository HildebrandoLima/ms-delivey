<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_create_a_successful_response(): void
    {
        // $telephone = Telefone::factory(3)->create()->toArray();
        $telephone = [
            'numero' => rand(100, 900),
            'tipo' => 'Fixo',
            'ddd_id' => 1,
            'usuario_id' => 1,
            'fornecedor_id' => 1,
        ];
        $response = $this->postJson('/api/telephone/save', $telephone);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_a_failure_response(): void
    {
        $telephone = [
            'numero' => '',
            'tipo' => 'Fixo',
            'ddd_id' => 1,
            'usuario_id' => 1,
            'fornecedor_id' => 1,
        ];
        $response = $this->postJson('/api/telephone/save', $telephone);
        $response->assertStatus(422);
    }
}
