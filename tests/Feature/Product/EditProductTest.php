<?php

namespace Tests\Feature\Product;

use App\Models\Produto;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class EditProductTest extends TestCase
{
    private function product(): array
    {
        return Produto::factory()->createOne()->toArray();
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $product = $this->product();
        $data = [
            'id' => $product['id'],
            'nome' => Str::random(10),
            'precoCusto' => $product['preco_custo'],
            'precoVenda' => $product['preco_venda'],
            'codigoBarra' => $product['codigo_barra'],
            'descricao' => $product['descricao'],
            'quantidade' => $product['quantidade'],
            'unidadeMedida' => $product['unidade_medida'],
            'dataValidade' => date('Y-m-d H:s:i'),
            'categoriaId' => $product['categoria_id'],
            'fornecedorId' => $product['fornecedor_id'],
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('product.edit'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $product = $this->product();
        $data = [
            'id' => $product['id'],
            'nome' => null,
            'precoCusto' => $product['preco_custo'],
            'precoVenda' => $product['preco_venda'],
            'codigoBarra' => null,
            'descricao' => $product['descricao'],
            'quantidade' => $product['quantidade'],
            'unidadeMedida' => $product['unidade_medida'],
            'dataValidade' => date('Y-m-d H:s:i'),
            'categoriaId' => $product['categoria_id'],
            'fornecedorId' => $product['fornecedor_id'],
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('product.edit'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $product = $this->product();
        $data = [
            'id' => $product['id'],
            'nome' => $product['nome'],
            'precoCusto' => $product['preco_custo'],
            'precoVenda' => $product['preco_venda'],
            'codigoBarra' => $product['codigo_barra'],
            'descricao' => $product['descricao'],
            'quantidade' => $product['quantidade'],
            'unidadeMedida' => $product['unidade_medida'],
            'dataValidade' => date('Y-m-d H:s:i'),
            'categoriaId' => $product['categoria_id'],
            'fornecedorId' => $product['fornecedor_id'],
            'ativo' => true,
        ];

        // Act
        $response = $this->putJson(route('product.edit'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_403(): void
    {
        // Arrange
        $product = $this->product();
        $data = [
            'id' => $product['id'],
            'nome' => $product['nome'],
            'precoCusto' => $product['preco_custo'],
            'precoVenda' => $product['preco_venda'],
            'codigoBarra' => $product['codigo_barra'],
            'descricao' => $product['descricao'],
            'quantidade' => $product['quantidade'],
            'unidadeMedida' => $product['unidade_medida'],
            'dataValidade' => date('Y-m-d H:s:i'),
            'categoriaId' => $product['categoria_id'],
            'fornecedorId' => $product['fornecedor_id'],
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('product.edit'), $data);

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
