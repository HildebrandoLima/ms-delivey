<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\ProductDto;

class ProductMapperDto
{
    public static function mapper(array $product): ProductDto
    {
        return new ProductDto
        (
            $product['id'] ?? 0,
            $product['nome'] ?? '',
            $product['preco_custo'] ?? '',
            $product['margem_lucro'] ?? '',
            $product['preco_venda'] ?? '',
            $product['codigo_barra'] ?? '',
            $product['descricao'] ?? '',
            $product['quantidade'] ?? 0,
            $product['unidade_medida'] ?? '',
            $product['data_validade'] ?? '',
            $product['categoria_id'] ?? 0,
            $product['fornecedor_id'] ?? 0,
            $product['imagem'] ?? [],
            $product['ativo'] ?? '',
            $product['created_at'] ?? '',
            $product['updated_at'] ?? '',
        );
    }
}
