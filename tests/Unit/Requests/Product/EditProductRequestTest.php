<?php

namespace Tests\Unit\Requests\Product;

use App\Http\Requests\Product\EditProductRequest;
use App\Models\Produto;
use Tests\TestCase;

class EditProductRequestTest extends TestCase
{
    private EditProductRequest $request;
    private array $unitMeasure = array('UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX');

    private function request(): EditProductRequest
    {
        $rand_keys = array_rand($this->unitMeasure);
        $product = Produto::query()->first()->toArray();
        $this->request = new EditProductRequest();
        $this->request['id'] = $product['id'];
        $this->request['nome'] = $product['nome'];
        $this->request['precoCusto'] = (float)$product['preco_custo'];
        $this->request['precoVenda'] = (float)$product['preco_venda'];
        $this->request['codigoBarra'] = $product['codigo_barra'];
        $this->request['descricao'] = $product['descricao'];
        $this->request['quantidade'] = $product['quantidade'];
        $this->request['unidadeMedida'] = $this->unitMeasure[$rand_keys];
        $this->request['dataValidade'] = date('Y-m-d H:i:s');
        $this->request['categoriaId'] = $product['categoria_id'];
        $this->request['fornecedorId'] = $product['fornecedor_id'];
        $this->request['ativo'] = (bool)$product['ativo'];
        return $this->request;
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultName = isset($this->request['nome']);
        $resultPriceCost = isset($this->request['precoCusto']);
        $resultSalePrice = isset($this->request['precoVenda']);
        $resultBarCode = isset($this->request['codigoBarra']);
        $resulDescription = isset($this->request['descricao']);
        $resultAmount = isset($this->request['quantidade']);
        $resultUnitMeasurement = isset($this->request['unidadeMedida']);
        $resultExpirationDate = isset($this->request['dataValidade']);
        $resultCategoryId = isset($this->request['categoriaId']);
        $resultProviderId = isset($this->request['fornecedorId']);
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultPriceCost);
        $this->assertTrue($resultSalePrice);
        $this->assertTrue($resultBarCode);
        $this->assertTrue($resulDescription);
        $this->assertTrue($resultAmount);
        $this->assertTrue($resultUnitMeasurement);
        $this->assertTrue($resultExpirationDate);
        $this->assertTrue($resultCategoryId);
        $this->assertTrue($resultProviderId);
        $this->assertTrue($resultActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultName = is_string($this->request['nome']);
        $resultPriceCost = is_float($this->request['precoCusto']);
        $resultSalePrice = is_float($this->request['precoVenda']);
        $resultBarCode = is_string($this->request['codigoBarra']);
        $resulDescription = is_string($this->request['descricao']);
        $resultAmount = is_int($this->request['quantidade']);
        $resultUnitMeasurement = is_string($this->request['unidadeMedida']);
        $resultExpirationDate = is_string($this->request['dataValidade']);
        $resultCategoryId = is_int($this->request['categoriaId']);
        $resultProviderId = is_int($this->request['fornecedorId']);
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultPriceCost);
        $this->assertTrue($resultSalePrice);
        $this->assertTrue($resultBarCode);
        $this->assertTrue($resulDescription);
        $this->assertTrue($resultAmount);
        $this->assertTrue($resultUnitMeasurement);
        $this->assertTrue($resultExpirationDate);
        $this->assertTrue($resultCategoryId);
        $this->assertTrue($resultProviderId);
        $this->assertTrue($resultActive);
    }

    public function test_request_count_caracter(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultBarCodeContString = strlen($this->request['codigoBarra']);
        if ($resultBarCodeContString == 13):
            $resultBarCode = true;
        endif;

        // Assert
        $this->assertTrue($resultBarCode);
    }
}
