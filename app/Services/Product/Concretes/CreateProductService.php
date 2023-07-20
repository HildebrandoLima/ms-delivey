<?php

namespace App\Services\Product\Concretes;

use App\Exceptions\HttpStatusCode\HttpBadRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\CreateProductServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Cases\ProductCase;
use App\Support\Utils\Enums\ImageEnum;
use App\Support\Utils\Enums\PermissionEnum;
use App\Support\Utils\Enums\ProductEnum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateProductService extends ValidationPermission implements CreateProductServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProductRepositoryInterface     $productRepository;
    private ImageRepositoryInterface       $imageRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        ProductRepositoryInterface     $productRepository,
        ImageRepositoryInterface       $imageRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->productRepository     = $productRepository;
        $this->imageRepository       = $imageRepository;
    }

    public function createProduct(ProductRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::CRIAR_PRODUTO);
        $this->checkEntityRepository->checkProductExist($request);
        $this->checkEntityRepository->checkProviderIdExist($request->fornecedorId);
        $product = $this->mapProduct($request);
        $productId = $this->productRepository->create($product);
        $this->createImage($request, $productId);
        return true;
    }

    private function mapProduct(ProductRequest $request): Produto
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

    private function createImage(ProductRequest $request, int $productId): void
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
        else:
            throw new HttpBadRequest('Nenhuma imagem foi selecionada.');
        endif;
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
