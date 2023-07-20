<?php

namespace App\Services\Product\Concretes;

use App\Http\Requests\ProductRequest;
use App\Models\Produto;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\EditProductServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Cases\ProductCase;
use App\Support\Utils\Enums\PermissionEnum;
use App\Support\Utils\Enums\ProductEnum;

class EditProductService extends ValidationPermission implements EditProductServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProductRepositoryInterface     $productRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        ProductRepositoryInterface     $productRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->productRepository     = $productRepository;
    }

    public function editProduct(int $id, ProductRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_PRODUTO);
        $this->checkEntityRepository->checkProviderIdExist($request->fornecedorId);
        $product = $this->map($request);
        return $this->productRepository->update($id, $product);
    }

    private function map(ProductRequest $request): Produto
    {
        $product = new Produto();
        $product->nome = $request->nome;
        $product->preco_custo = $request->precoCusto;
        $product->preco_venda = $request->precoVenda;
        $product->margem_lucro = $request->precoVenda - $request->precoCusto;
        $product->codigo_barra = $request->codigoBarra;
        $product->descricao = $request->descricao;
        $product->quantidade = $request->quantidade;
        $product->unidade_medida = ProductCase::productCase($request['unidadeMedida']);
        $product->data_validade = $request->dataValidade;
        $product->categoria_id = $request->categoriaId;
        $product->fornecedor_id = $request->fornecedorId;
        $request->ativo == true ? $product->ativo = ProductEnum::ATIVADO : $product->ativo = ProductEnum::DESATIVADO;
        return $product;
    }
}
