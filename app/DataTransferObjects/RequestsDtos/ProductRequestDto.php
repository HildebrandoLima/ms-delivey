<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\ProductDto;
use App\Http\Requests\ProductRequest;
use App\Support\Utils\Cases\ProductCase;

class ProductRequestDto
{
    public static function fromRquest(ProductRequest $request): ProductDto
    {
        $productDto = new ProductDto();
        $unitMeasure = new ProductCase();
        $productDto->setNome($request['nome']);
        $productDto->setPrecoCusto($request['precoCusto']);
        $productDto->setPrecoVenda($request['precoVenda']);
        $productDto->setMargemLucro($request['precoVenda'] - $request['precoCusto']);
        $productDto->setCodigoBarra($request['codigoBarra']);
        $productDto->setDescricao($request['descricao']);
        $productDto->setQuantidade($request['quantidade']);
        $productDto->setUnidadeMedida($unitMeasure->productCase($request['unidadeMedida']));
        $productDto->setDataValidade($request['dataValidade']);
        $productDto->setCategoriaId($request['categoriaId']);
        $productDto->setFornecedorId($request['fornecedorId']);
        $productDto->setAtivo($request['ativo']);
        return $productDto;
    }
}
