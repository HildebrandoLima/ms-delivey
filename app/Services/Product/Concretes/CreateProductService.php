<?php

namespace App\Services\Product\Concretes;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Product\Abstracts\ICreateProductService;
use App\Support\Enums\AtivoEnum;

class CreateProductService implements ICreateProductService
{
    private IEntityRepository $entityRepository;

    public function __construct(IEntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function createProduct(CreateProductRequest $request): bool
    {
        $product = $this->mapProduct($request);
        $productId = $this->entityRepository->create($product);
        $images = $this->createImage($request, $productId);
        if ($productId and $images):
            return true;
        else:
            return false;
        endif;
    }

    private function mapProduct(CreateProductRequest $request): Produto
    {
        $product = new Produto();
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
        $product->ativo = AtivoEnum::ATIVADO;
        return $product;
    }

    private function createImage(CreateProductRequest $request, int $productId): bool
    {
        $uploadedImages = [];
        if ($request->hasFile('imagens')):
            $images = $request->file('imagens');
            foreach ($images as $image):
                $imageName = $image->getClientOriginalName();
                $directory = 'images/' . uniqid();
                $image->storeAs($directory, $imageName, 'public');
                $uploadedImages[] = $imageName;
                $imageModel = $this->mapImage($directory . '/' . $imageName, $productId);
                $this->entityRepository->create($imageModel);
            endforeach;
            return true;
        else:
            return false;
        endif;
    }

    private function mapImage(string $path, int $productId): Imagem
    {
        $image = new Imagem();
        $image->caminho = $path;
        $image->produto_id = $productId;
        $image->ativo = AtivoEnum::ATIVADO;
        return $image;
    }
}
