<?php

namespace Tests\Feature\Order;

use App\Models\Produto;
use App\Models\User;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    private int $count = 3;
    private float $total = 0;

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $products = Produto::query()->limit($this->count)->get()->toArray();
        $data['itens'] = [];
        foreach ($products as $product):
            $item = [
                'nome' => $product['nome'],
                'preco' => $product['preco_venda'],
                'codigoBarra' => $product['codigo_barra'],
                'quantidadeItem' => $product['quantidade'],
                'subTotal' => $product['preco_venda'],
                'unidadeMedida' => $product['unidade_medida'],
                'produtoId' => $product['id'],
                'ativo' => $product['ativo'],
            ];
            $this->total += $product['preco_venda'];
            array_push($data['itens'], $item);
        endforeach;
        $data = [
            'quantidadeItens' => $this->count,
            'total' => $this->total,
            'entrega' => 3.5,
            'usuarioId' => User::query()->first()->id,
            'ativo' => true,
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
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            'quantidadeItems' => $this->count,
            'total' => $this->total,
            'entrega' => 3.5,
            'usuarioId' => User::query()->first()->id,
            'ativo' => true,
            'items' => [],
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
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $products = Produto::query()->limit($this->count)->get()->toArray();
        $data['items'] = [];
        foreach ($products as $product):
            $item = [
                'nome' => $product['nome'],
                'preco' => $product['preco_venda'],
                'codigoBarra' => $product['codigo_barra'],
                'quantidadeItem' => $product['quantidade'],
                'subTotal' => $product['preco_venda'],
                'unidadeMedida' => $product['unidade_medida'],
                'produtoId' => $product['id'],
                'ativo' => $product['ativo'],
            ];
            $this->total += $product['preco_venda'];
            array_push($data['items'], $item);
        endforeach;
        $data = [
            'quantidadeItems' => $this->count,
            'total' => $this->total,
            'entrega' => 3.5,
            'usuarioId' => User::query()->first()->id,
            'ativo' => true,
            'items' => $data['items'],
        ];

        // Act
        $response = $this->postJson(route('order.save', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
