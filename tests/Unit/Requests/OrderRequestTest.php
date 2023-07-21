<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\OrderRequest;
use App\Models\Produto;
use App\Models\User;
use Tests\TestCase;

class OrderRequestTest extends TestCase
{
    private OrderRequest $request;
    private int $count = 3;
    private float $total = 0;

    private function request(): OrderRequest
    {
        $products = Produto::query()->limit($this->count)->get()->toArray();
        $data['itens'] = [];
        foreach ($products as $product):
            $item = [
                'nome' => $product['nome'],
                'preco' => (float)$product['preco_venda'],
                'codigoBarra' => $product['codigo_barra'],
                'quantidadeItem' => $product['quantidade'],
                'subTotal' => (float)$product['preco_venda'],
                'unidadeMedida' => $product['unidade_medida'],
                'produtoId' => $product['id'],
                'ativo' => true,
            ];
            $this->total += $product['preco_venda'];
            array_push($data['itens'], $item);
        endforeach;

        $this->request = new OrderRequest();
        $this->request['quantidadeItens'] = $this->count;
        $this->request['total'] = $this->total;
        $this->request['entrega'] = 3.5;
        $this->request['usuarioId'] = User::query()->first()->id;
        $this->request['ativo'] = true;
        $this->request['itens'] = $data['itens'];
        return $this->request;
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultQuantityOfItems = isset($this->request['quantidadeItens']);
        $resultTotal = isset($this->request['total']);
        $resultDelivery = isset($this->request['entrega']);
        $resultUserId = isset($this->request['usuarioId']);
        $resultActive = isset($this->request['ativo']);
        $resultItems = isset($this->request['itens']);
        $resultItemsName = isset($this->request['itens'][0]['nome']);
        $resultItemsPrice = isset($this->request['itens'][0]['preco']);
        $resultItemsBarCode = isset($this->request['itens'][0]['codigoBarra']);
        $resultItemsQuantityItem = isset($this->request['itens'][0]['quantidadeItem']);
        $resultItemsSubTotal = isset($this->request['itens'][0]['subTotal']);
        $resultItemsUnitMeasurement = isset($this->request['itens'][0]['unidadeMedida']);
        $resultItemsProductId = isset($this->request['itens'][0]['produtoId']);
        $resultItemsActive = isset($this->request['itens'][0]['ativo']);

        // Assert
        $this->assertTrue($resultQuantityOfItems);
        $this->assertTrue($resultTotal);
        $this->assertTrue($resultDelivery);
        $this->assertTrue($resultUserId);
        $this->assertTrue($resultActive);
        $this->assertTrue($resultItems);
        $this->assertTrue($resultItemsName);
        $this->assertTrue($resultItemsPrice);
        $this->assertTrue($resultItemsBarCode);
        $this->assertTrue($resultItemsQuantityItem);
        $this->assertTrue($resultItemsSubTotal);
        $this->assertTrue($resultItemsUnitMeasurement);
        $this->assertTrue($resultItemsProductId);
        $this->assertTrue($resultItemsActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultQuantityOfItems = is_int($this->request['quantidadeItens']);
        $resultTotal = is_float($this->request['total']);
        $resultDelivery = is_float($this->request['entrega']);
        $resultUserId = is_int($this->request['usuarioId']);
        $resultActive = is_bool($this->request['ativo']);
        $resultItems = is_array($this->request['itens']);
        $resultItemsName = is_string($this->request['itens'][0]['nome']);
        $resultItemsPrice = is_float($this->request['itens'][0]['preco']);
        $resultItemsBarCode = is_string($this->request['itens'][0]['codigoBarra']);
        $resultItemsQuantityItem = is_int($this->request['itens'][0]['quantidadeItem']);
        $resultItemsSubTotal = is_float($this->request['itens'][0]['subTotal']);
        $resultItemsUnitMeasurement = is_string($this->request['itens'][0]['unidadeMedida']);
        $resultItemsProductId = is_int($this->request['itens'][0]['produtoId']);
        $resultItemsActive = is_bool($this->request['itens'][0]['ativo']);

        // Assert
        $this->assertTrue($resultQuantityOfItems);
        $this->assertTrue($resultTotal);
        $this->assertTrue($resultDelivery);
        $this->assertTrue($resultUserId);
        $this->assertTrue($resultActive);
        $this->assertTrue($resultItems);
        $this->assertTrue($resultItemsName);
        $this->assertTrue($resultItemsPrice);
        $this->assertTrue($resultItemsBarCode);
        $this->assertTrue($resultItemsQuantityItem);
        $this->assertTrue($resultItemsSubTotal);
        $this->assertTrue($resultItemsUnitMeasurement);
        $this->assertTrue($resultItemsProductId);
        $this->assertTrue($resultItemsActive);
    }
}
