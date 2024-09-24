<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IListFindByIdProductRepository;
use App\Domains\Dtos\ProductDto;
use App\Domains\Services\Product\Interfaces\IListFindByIdProductService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdProductService implements IListFindByIdProductService
{
    use RequestConfigurator, ListPaginationMapper;

    private IListFindByIdProductRepository $listFindByIdProductRepository;

    public function __construct(IListFindByIdProductRepository $listFindByIdProductRepository)
    {
        $this->listFindByIdProductRepository = $listFindByIdProductRepository;
    }

    public function listFindById(Request $request): Collection
    {
        $this->setRequest($request);
        return $this->listCollection();
    }

    private function listCollection(): Collection
    {
        $listCollection = $this->listFindByIdProductRepository->listFindById($this->request->id, $this->request->active);
        return $this->mapToDtoList($listCollection, ProductDto::class);
    }
}
