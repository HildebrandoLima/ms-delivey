<?php

namespace App\Services\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Produto;
use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\IEditProductSerice;
use App\Support\Utils\Cases\ProductCase;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\Enums\ProductEnums;

class EditProductSerice implements IEditProductSerice
{
    private CheckProvider $checkProvider;
    private ProductCase $productCase;
    private ProductRepository $productRepository;

    public function __construct
    (
        CheckProvider     $checkProvider,
        ProductCase       $productCase,
        ProductRepository $productRepository
    )
    {
        $this->checkProvider     = $checkProvider;
        $this->productCase       = $productCase;
        $this->productRepository = $productRepository;
    }

    public function editProduct(int $id, ProductRequest $request): bool
    {
        $this->checkProvider->checkProviderIdExist($id);
        $provider = $this->mapToModel($request);
        return $this->productRepository->update($id, $provider);
    }

    private function mapToModel(ProductRequest $request): Produto
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
