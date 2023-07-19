<?php

namespace Tests\Feature\Payment;

use App\Models\Pedido;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePaymentTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_card(): void
    {
        // Arrange
        $data = [
            'numeroCartao' => rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200),
            'dataValidade' =>  date('Y-m-d H:i:s'),
            'parcela' => rand(0, 2),
            'total' => rand(1, 100),
            'metodoPagamentoId' => 2,
            'pedidoId' => Pedido::factory()->createOne()->id,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('payment.save', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_money(): void
    {
        // Arrange
        $data = [
            'numeroCartao' => null,
            'dataValidade' =>  null,
            'parcela' => null,
            'total' => rand(1, 100),
            'metodoPagamentoId' => 4,
            'pedidoId' => Pedido::factory()->createOne()->id,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('payment.save', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            'numeroCartao' => null,
            'dataValidade' =>  null,
            'parcela' => null,
            'total' => rand(1, 100),
            'metodoPagamentoId' => 4,
            'pedidoId' => '',
            'ativo' => '',
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('payment.save', $data));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $data = [
            'numeroCartao' => rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200),
            'dataValidade' =>  date('Y-m-d H:i:s'),
            'parcela' => rand(0, 2),
            'total' => rand(1, 100),
            'metodoPagamentoId' => 2,
            'pedidoId' => Pedido::factory()->createOne()->id,
            'ativo' => true,
        ];

        // Act
        $response = $this->postJson(route('payment.save', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
