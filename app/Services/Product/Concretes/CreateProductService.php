<?php

namespace App\Services\Product\Concretes;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\CreateProductServiceInterface;
use App\Support\Cases\ProductCase;
use App\Support\Enums\ImageEnum;
use App\Support\Enums\ProductEnum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateProductService implements CreateProductServiceInterface
{
    private ProductRepositoryInterface $productRepository;
    private ImageRepositoryInterface   $imageRepository;

    public function __construct
    (
        ProductRepositoryInterface $productRepository,
        ImageRepositoryInterface   $imageRepository,
    )
    {
        $this->productRepository = $productRepository;
        $this->imageRepository   = $imageRepository;
    }

    public function createProduct(CreateProductRequest $request): bool
    {
        $product = $this->mapProduct($request);
        $productId = $this->productRepository->create($product);
        $this->createImage($request, $productId);
        return true;
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
        $product->unidade_medida = ProductCase::productCase($request['unidadeMedida']);
        $product->data_validade = $request->dataValidade;
        $product->categoria_id = $request->categoriaId;
        $product->fornecedor_id = $request->fornecedorId;
        $product->ativo = ProductEnum::ATIVADO;
        return $product;
    }

    private function createImage(CreateProductRequest $request, int $productId): bool
    {
        //$images = $request->file('imagens');
        $images = $request['imagens'];
        if (isset($images) && is_array($images)):
            foreach ($images as $image):
                $originalFileName = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $newFileName = Str::uuid() . '.' . $extension;
                //$path = $image->store('images', 'public');
                Storage::put('public/images/'. $newFileName, (string)$originalFileName, 'public');
                $path = 'public/images/' . $newFileName;
                $image = $this->mapImage($path, $productId);
                $this->imageRepository->create($image);
            endforeach;
        endif;
        return true;
    }

    private function mapImage(string $path, int $productId): Imagem
    {
        $image = new Imagem();
        $image->caminho = $path;
        $image->produto_id = $productId;
        $image->ativo = ImageEnum::ATIVADO;
        return $image;
    }
}
