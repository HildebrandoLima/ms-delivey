<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IListFindByIdProductRepository;
use App\Domains\Services\Product\Interfaces\IListFindByIdProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdProductService implements IListFindByIdProductService
{
    private IListFindByIdProductRepository $listFindByIdProductRepository;

    public function __construct(IListFindByIdProductRepository $listFindByIdProductRepository)
    {
        $this->listFindByIdProductRepository = $listFindByIdProductRepository;
    }

    public function listFindById(Request $request): Collection
    {
        return $this->listFindByIdProductRepository->listFindById($request->id, (bool)$request->active);
    }
}
