<?php

namespace Tests\Feature\Address;

use App\Models\Endereco;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnableDisableAddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_200(): void
    {
        // Arrange
        $data = Endereco::query()->first()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('address.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_400(): void
    {
        // Arrange
        $data = Endereco::query()->first()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('address.enable.disable', ['id' => base64_encode($data['id'])]));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_401(): void
    {
        // Arrange
        $data = Endereco::query()->first()->toArray();

        // Act
        $response = $this->putJson(route('address.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
