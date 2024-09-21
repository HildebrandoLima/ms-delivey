<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IListFindByIdCategoryRepository;
use App\Domains\Services\Category\Interfaces\IListFindByIdCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdCategoryService implements IListFindByIdCategoryService
{
    private IListFindByIdCategoryRepository $listFindByIdCategoryRepository;

    public function __construct(IListFindByIdCategoryRepository $listFindByIdCategoryRepository)
    {
        $this->listFindByIdCategoryRepository = $listFindByIdCategoryRepository;
    }

    public function listFindById(Request $request): Collection
    {
        return $this->listFindByIdCategoryRepository->listFindById($request->id, (bool)$request->active);
    }
}
