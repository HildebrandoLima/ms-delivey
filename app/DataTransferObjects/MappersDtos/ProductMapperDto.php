<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\ProductDto;

class ProductMapperDto
{
    public static function mapper(array $product): ProductDto
    {
        return ProductDto::construction()
        ->setProdutoId($product['id'] ?? 0)
        ->setNome($product['nome'] ?? '')
        ->setPrecoCusto($product['preco_custo'] ?? '')
        ->setPrecoVenda($product['margem_lucro'] ?? '')
        ->setPrecoVenda($product['preco_venda'] ?? '')
        ->setCodigoBarra($product['codigo_barra'] ?? '')
        ->setDescricao($product['descricao'] ?? '')
        ->setQuantidade($product['quantidade'] ?? 0)
        ->setUnidadeMedida($product['unidade_medida'] ?? '')
        ->setDataValidade($product['data_validade'] ?? '')
        ->setCategoriaId($product['categoria_id'] ?? 0)
        ->setFornecedorId($product['fornecedor_id'] ?? 0)
        ->setImagens($product['imagem'] ?? [])
        ->setAtivo($product['ativo'] ?? '')
        ->setCriadoEm($product['created_at'] ?? '')
        ->setAlteradoEm($product['updated_at'] ?? '');
    }
}
