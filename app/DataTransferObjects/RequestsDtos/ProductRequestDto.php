<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\ProductDto;
use App\Http\Requests\ProductRequest;

class ProductRequestDto
{
    public static function fromRquest(ProductRequest $request): ProductDto
    {
        $productDto = new ProductDto();
        $productDto->setNome($request['nome']);
        $productDto->setPrecoCusto($request['precoCusto']);
        $productDto->setPrecoVenda($request['precoVenda']);
        $productDto->setMargemLucro($request['precoVenda'] - $request['precoCusto']);
        $productDto->setCodigoBarra($request['codigoBarra']);
        $productDto->setDescricao($request['descricao']);
        $productDto->setQuantidade($request['quantidade']);
        $productDto->setUnidadeMedida($request['unidadeMedida']);
        $productDto->setDataValidade($request['dataValidade']);
        $productDto->setCategoriaId($request['categoriaId']);
        $productDto->setFornecedorId($request['fornecedorId']);
        $productDto->setAtivo($request['ativo']);
        return $productDto;
    }
}
