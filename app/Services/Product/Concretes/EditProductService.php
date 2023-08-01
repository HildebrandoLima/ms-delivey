<?php

namespace App\Services\Product\Concretes;

use App\Http\Requests\Product\EditProductRequest;
use App\Models\Produto;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\EditProductServiceInterface;
use App\Support\Enums\AtivoEnum;

class EditProductService implements EditProductServiceInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function editProduct(EditProductRequest $request): bool
    {
        $product = $this->map($request);
        return $this->productRepository->update($product);
    }

    private function map(EditProductRequest $request): Produto
    {
        $product = new Produto();
        $product->id = $request->id;
        $product->nome = $request->nome;
        $product->preco_custo = $request->precoCusto;
        $product->preco_venda = $request->precoVenda;
        $product->margem_lucro = $request->precoVenda - $request->precoCusto;
        $product->codigo_barra = $request->codigoBarra;
        $product->descricao = $request->descricao;
        $product->quantidade = $request->quantidade;
        $product->unidade_medida = $request->unidadeMedida;
        $product->data_validade = $request->dataValidade;
        $product->categoria_id = $request->categoriaId;
        $product->fornecedor_id = $request->fornecedorId;
        $product->ativo = $request->ativo == true ? AtivoEnum::ATIVADO->value : AtivoEnum::DESATIVADO->value;
        return $product;
    }
}
