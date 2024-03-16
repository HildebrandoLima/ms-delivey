<?php

namespace App\Services\Product\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Http\Requests\Product\EditProductRequest;
use App\Domains\Models\Imagem;
use App\Domains\Models\Produto;
use App\Services\Product\Abstracts\IEditProductService;
use App\Support\Enums\AtivoEnum;
use App\Support\Utils\PriceFormat\PriceFormat;

class EditProductService implements IEditProductService
{
    private IEntityRepository $productRepository;

    public function __construct(IEntityRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function editProduct(EditProductRequest $request): bool
    {
        $listImages = $this->productRepository->read((new Imagem()), $request->id);

        foreach ($listImages as $instance):
            $image = $this->mapImage($instance->id, $request->ativo);
            $this->productRepository->update($image);
        endforeach;

        $product = $this->mapProduct($request);
        return $this->productRepository->update($product);
    }

    public function mapImage(int $id, bool $ativo): Imagem
    {
        $image = new Imagem();
        $image->id = $id;
        $image->ativo = $ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $image;
    }

    public function mapProduct(EditProductRequest $request): Produto
    {
        $precoCusto = str_replace(',', '.', PriceFormat::priceFormart($request->precoCusto));
        $precoVenda = str_replace(',', '.', PriceFormat::priceFormart($request->precoVenda));

        $product = new Produto();
        $product->id = $request->id;
        $product->nome = $request->nome;
        $product->preco_custo = $precoCusto;
        $product->preco_venda = $precoVenda;
        $product->margem_lucro = $precoVenda - $precoCusto;
        $product->codigo_barra = $request->codigoBarra;
        $product->descricao = $request->descricao;
        $product->quantidade = $request->quantidade;
        $product->unidade_medida = $request->unidadeMedida;
        $product->data_validade = $request->dataValidade;
        $product->categoria_id = $request->categoriaId;
        $product->fornecedor_id = $request->fornecedorId;
        $product->ativo = $request->ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $product;
    }
}
