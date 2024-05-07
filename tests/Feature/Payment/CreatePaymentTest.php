<?php

namespace Tests\Feature\Payment;

use App\Models\Pedido;
use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePaymentTest extends TestCase
{
    private array $typeCard = array('Crédito', 'Débito');
    private array $typePayment = array('Crédito', 'Débito');

    /**
     * @test
     * @group payment
     */
    public function it_endpoint_post_create_card_base_response_200(): void
    {
        // Arrange
        $randKeysCard = array_rand($this->typeCard);
        $randKeysPayment = array_rand($this->typePayment);
        $data = [
            'numeroCartao' => rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200),
            'tipoCartao' => $this->typeCard[$randKeysCard],
            'dataValidade' => date('Y-m-d H:i:s'),
            'ccv' => rand(100, 100),
            'parcela' => rand(0, 2),
            'total' => rand(1, 100),
            'metodoPagamento' => $this->typeCard[$randKeysPayment],
            'pedidoId' => Pedido::factory()->createOne()->id,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

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
     * @group payment
     */
    public function it_endpoint_post_create_money_base_response_200(): void
    {
        // Arrange
        $data = [
            'numeroCartao' => null,
            'dataValidade' =>  null,
            'tipoCartao' => null,
            'ccv' => null,
            'parcela' => null,
            'total' => rand(1, 100),
            'metodoPagamento' => 'Boleto Bancário' ?? 'Pix',
            'pedidoId' => Pedido::factory()->createOne()->id,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

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
     * @group payment
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            'numeroCartao' => null,
            'tipoCartao' => null,
            'dataValidade' =>  null,
            'ccv' => null,
            'parcela' => null,
            'total' => rand(1, 100),
            'metodoPagamento' => 'Boleto Bancário',
            'pedidoId' => null,
            'ativo' => null,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('payment.save', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group payment
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $randKeys = array_rand($this->typeCard);
        $data = [
            'numeroCartao' => rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200),
            'tipoCartao' => $this->typeCard[$randKeys],
            'ccv' => rand(100, 100),
            'dataValidade' =>  date('Y-m-d H:i:s'),
            'parcela' => rand(0, 2),
            'total' => rand(1, 100),
            'metodoPagamento' => 'Boleto Bancário',
            'pedidoId' => Pedido::factory()->createOne()->id,
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->postJson(route('payment.save', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group payment
     */
    public function it_endpoint_post_base_response_404(): void
    {
        // Arrange
        $randKeysCard = array_rand($this->typeCard);
        $randKeysPayment = array_rand($this->typePayment);
        $data = [
            'numeroCartao' => rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200),
            'tipoCartao' => $this->typeCard[$randKeysCard],
            'dataValidade' => date('Y-m-d H:i:s'),
            'ccv' => rand(100, 100),
            'parcela' => rand(0, 2),
            'total' => rand(1, 100),
            'metodoPagamento' => $this->typeCard[$randKeysPayment],
            'pedidoId' => 1000,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('payment.save', $data));

        // Assert
        $response->assertNotFound();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 404);
    }
}
