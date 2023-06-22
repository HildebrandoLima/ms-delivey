<?php

namespace App\Services\Product\Concretes;

use App\DataTransferObjects\RequestsDtos\ImageRequestDto;
use App\DataTransferObjects\RequestsDtos\ProductRequestDto;
use App\Exceptions\HttpBadRequest;
use App\Http\Requests\ProductRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\CreateProductServiceInterface;

class CreateProductService implements CreateProductServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private ProductRepositoryInterface     $productRepositoryInterface;
    private ImageRepositoryInterface       $imageRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        ProductRepositoryInterface     $productRepositoryInterface,
        ImageRepositoryInterface       $imageRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->productRepositoryInterface     = $productRepositoryInterface;
        $this->imageRepositoryInterface       = $imageRepositoryInterface;
    }

    public function createProduct(ProductRequest $request): bool
    {
        $this->checkEntityRepositoryInterface->checkProductExist($request);
        $this->checkEntityRepositoryInterface->checkProviderIdExist($request->fornecedorId);
        $product = ProductRequestDto::fromRquest($request);
        $createProduct = $this->productRepositoryInterface->create($product);
        $this->createImage($request, $createProduct->id);
        return true;
    }

    private function createImage(ProductRequest $request, int $productId): void
    {
        $images = $request->file('imagens');
        if (isset ($images)):
            foreach ($images as $image):
                $path = $image->store('images', 'public');
                $image = ImageRequestDto::fromRquest($path, $productId);
                $this->imageRepositoryInterface->create($image);
            endforeach;
        else:
            throw new HttpBadRequest('Nenhuma imagem foi selecionada.');
        endif;
    }
}