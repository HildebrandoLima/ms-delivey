<?php

namespace App\Services\Product\Concretes;

use App\DataTransferObjects\RequestsDtos\ProductRequestDto;
use App\Http\Requests\ProductRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\EditProductSericeInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

class EditProductSerice extends ValidationPermission implements EditProductSericeInterface
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
        $this->checkEntityRepository->checkProviderIdExist($id);
        $product = ProductRequestDto::fromRquest($request);
        return $this->productRepository->update($id, $product);
    }
}
