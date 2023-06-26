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
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

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
        $product = ProductRequestDto::fromRquest($request);
        $createProduct = $this->productRepository->create($product);
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
                $this->imageRepository->create($image);
            endforeach;
        else:
            throw new HttpBadRequest('Nenhuma imagem foi selecionada.');
        endif;
    }
}
