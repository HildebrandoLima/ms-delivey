<?php

namespace Tests\Feature\Order;

use App\Models\Endereco;
use App\Models\Produto;
use App\Models\User;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    private array $typeDelivery = array('Expresso', 'Correio', 'Retirada');
    private int $count = 3;
    private float $total = 0;

    private function product(): array
    {
        return Produto::factory($this->count)->create()->toArray();
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $randKeys = array_rand($this->typeDelivery);
        $products = $this->product();
        $data['itens'] = [];
        foreach ($products as $product):
            $item = [
                'nome' => $product['nome'],
                'preco' => $product['preco_venda'],
                'quantidadeItem' => $product['quantidade'],
                'subTotal' => $product['preco_venda'],
                'produtoId' => $product['id'],
            ];
            $this->total += $product['preco_venda'];
            array_push($data['itens'], $item);
        endforeach;
        $data = [
            'quantidadeItens' => $this->count,
            'total' => $this->total,
            'tipoEntrega' => $this->typeDelivery[$randKeys],
            'valorEntrega' => 3.5,
            'usuarioId' => User::factory()->createOne()->id,
            'enderecoId' => Endereco::factory()->createOne()->id,
            'itens' => $data['itens'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('order.save', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            'quantidadeItems' => $this->count,
            'total' => $this->total,
            'tipoEntrega' => null,
            'valorEntrega' => null,
            'usuarioId' => User::factory()->createOne()->id,
            'enderecoId' => Endereco::factory()->createOne()->id,
            'itens' => [],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('order.save', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $randKeys = array_rand($this->typeDelivery);
        $products = $this->product();
        $data['itens'] = [];
        foreach ($products as $product):
            $item = [
                'nome' => $product['nome'],
                'preco' => $product['preco_venda'],
                'quantidadeItem' => $product['quantidade'],
                'subTotal' => $product['preco_venda'],
                'produtoId' => $product['id'],
            ];
            $this->total += $product['preco_venda'];
            array_push($data['itens'], $item);
        endforeach;
        $data = [
            'quantidadeItems' => $this->count,
            'total' => $this->total,
            'tipoEntrega' => $this->typeDelivery[$randKeys],
            'valorEntrega' => 3.5,
            'usuarioId' => User::factory()->createOne()->id,
            'enderecoId' => Endereco::factory()->createOne()->id,
            'itens' => $data['itens'],
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->postJson(route('order.save', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
