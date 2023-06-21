<?php

namespace App\Services\Product;

use App\DataTransferObjects\RequestsDtos\ImageRequestDto;
use App\DataTransferObjects\RequestsDtos\ProductRequestDto;
use App\Exceptions\HttpBadRequest;
use App\Http\Requests\ProductRequest;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\ICreateProductService;

class CreateProductService implements ICreateProductService
{
    private CheckRegisterRepository    $checkRegisterRepository;
    private ProductRepositoryInterface $productRepositoryInterface;
    private ImageRepositoryInterface   $imageRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository    $checkRegisterRepository,
        ProductRepositoryInterface $productRepositoryInterface,
        ImageRepositoryInterface   $imageRepositoryInterface,
    )
    {
        $this->checkRegisterRepository    = $checkRegisterRepository;
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->imageRepositoryInterface   = $imageRepositoryInterface;
    }

    public function createProduct(ProductRequest $request): bool
    {
        $this->checkRegisterRepository->checkProductExist($request);
        $this->checkRegisterRepository->checkProviderIdExist($request->fornecedorId);
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
