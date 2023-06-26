<?php

namespace App\Services\Product\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\ListProductServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;
use Illuminate\Support\Collection;

class ListProductService extends ValidationPermission implements ListProductServiceInterface
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

    public function listProductAll(int $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_PRODUTO);
        return $this->productRepository->getAll($active);
    }

    public function listProductFind(int $id, string $search, int $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_PRODUTO);
        if ($id != 0) $this->checkEntityRepository->checkProductIdExist($id);
        return $this->productRepository->getOne($id, $search, $active);
    }
}
