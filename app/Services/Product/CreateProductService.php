<?php

namespace App\Services\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Produto;
use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\ICreateProductService;
use App\Support\Utils\Cases\ProductCase;
use App\Support\Utils\CheckRegister\CheckProduct;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\Enums\ProductEnums;

class CreateProductService implements ICreateProductService
{
    private CheckProduct $checkProduct;
    private CheckProvider $checkProvider;
    private ProductCase $productCase;
    private ProductRepository $productRepository;

    public function __construct
    (
        CheckProduct      $checkProduct,
        CheckProvider     $checkProvider,
        ProductCase       $productCase,
        ProductRepository $productRepository
    )
    {
        $this->checkProduct      = $checkProduct;
        $this->checkProvider     = $checkProvider;
        $this->productCase       = $productCase;
        $this->productRepository = $productRepository;
    }

    public function createProduct(ProductRequest $request): int
    {
        $this->checkProduct->checkProductExist($request);
        $this->checkProvider->checkProviderIdExist($request->fornecedorId);
        $product = $this->mapToModel($request);
        return $this->productRepository->insert($product);
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
        $product->ativo = ProductEnums::ATIVADO;
        return $product;
    }
}
