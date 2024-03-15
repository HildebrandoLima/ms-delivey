<?php

namespace Tests\Feature\Address;

use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateAddressTest extends TestCase
{
    /**
     * @test
     * @group address
     */
    public function it_endpoint_post_create_user_base_response_200(): void
    {
        // Arrange
        $data = [
            'logradouro' => Str::random(10),
            'numero' => rand(1000, 1000),
            'bairro' => Str::random(10),
            'cidade' => Str::random(10),
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'uf' => 'CE',
            'usuarioId' => User::query()->first()->id,
        ];

        // Act
        $response = $this->postJson(route('address.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group address
     */
    public function it_endpoint_post_create_provider_base_response_200(): void
    {
        // Arrange
        $data = [
            'logradouro' => Str::random(10),
            'numero' => rand(1, 100),
            'bairro' => Str::random(10),
            'cidade' => Str::random(10),
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'uf' => 'CE',
            'fornecedorId' => Fornecedor::query()->first()->id,
        ];

        // Act
        $response = $this->postJson(route('address.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group address
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            'logradouro' => Str::random(10),
            'numero' => rand(1, 100),
            'bairro' => Str::random(10),
            'cidade' => Str::random(10),
            'cep' => null,
            'ufId' => rand(1, 27),
            'usuarioId' => null,
        ];

        // Act
        $response = $this->postJson(route('address.save'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
