<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\ProductRequest;
use App\Models\Produto;
use App\Support\Utils\Cases\ProductCase;
use App\Support\Utils\Enums\ProductEnums;

class ProductModel {
    private ProductCase $productCase;

    public function __construct(ProductCase $productCase)
    {
        $this->productCase = $productCase;
    }

    public function productModel(ProductRequest $request): Produto
    {
        $product = new Produto();
        $product->nome = $request->nome;
        $product->preco_custo = $request->precoCusto;
        $product->margem_lucro = ($request->precoVenda - $request->precoCusto);
        $product->preco_venda = $request->precoVenda;
        $product->codigo_barra = $request->codigoBarra;
        $product->descricao = $request->descricao;
        $product->quantidade = $request->quantidade;
        $product->unidade_medida = $this->productCase->productCase($request->unidadeMedida);
        $product->data_validade = $request->dataValidade;
        $product->categoria_id = $request->categoriaId;
        $product->fornecedor_id = $request->fornecedorId;
        $request->ativo == 1 ? $product->ativo = ProductEnums::ATIVADO : $product->ativo = ProductEnums::DESATIVADO;
        return $product;
    }
}
