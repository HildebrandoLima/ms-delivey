<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\ProductRequest;
use App\Models\Produto;
use App\Support\Utils\Cases\ProductCase;
use App\Support\Utils\Enums\ProductEnums;
use DateTime;

class ProductModel {
    private ProductCase $productCase;

    public function __construct(ProductCase $productCase)
    {
        $this->productCase = $productCase;
    }

    public function productModel(ProductRequest $request, string $method): Produto
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
        $method == 'create' ? $product->created_at = new DateTime() : $product->updated_at = new DateTime();
        return $product;
    }
}
