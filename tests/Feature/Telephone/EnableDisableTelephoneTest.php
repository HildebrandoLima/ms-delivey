<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnableDisableTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_200(): void
    {
        // Arrange
        $data = Telefone::factory()->createOne()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_400(): void
    {
        // Arrange
        $data = Telefone::factory()->createOne()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.enable.disable', ['id' => base64_encode($data['id']), 'active' => 1]));

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_401(): void
    {
        // Arrange
        $data = Telefone::factory()->createOne()->toArray();

        // Act
        $response = $this->putJson(route('telephone.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
