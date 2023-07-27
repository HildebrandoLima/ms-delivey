<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnableDisableTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_200(): void
    {
        // Arrange
        $telephone = Telefone::factory()->createOne()->toArray();
        $data = [
            'id' => $telephone['id'],
            'active' => false
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.enable.disable', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_400(): void
    {
        // Arrange
        $telephone = Telefone::query()->first()->toArray();
        $data = [
            'id' => $telephone['id'],
            'active' => false
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.enable.disable', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_401(): void
    {
        // Arrange
        $telephone = Telefone::query()->first()->toArray();
        $data = [
            'id' => $telephone['id'],
            'active' => false
        ];

        // Act
        $response = $this->putJson(route('telephone.enable.disable', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
