<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IListFindByIdCategoryRepository;
use App\Domains\Dtos\CategoryDto;
use App\Domains\Services\Category\Interfaces\IListFindByIdCategoryService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdCategoryService implements IListFindByIdCategoryService
{
    use RequestConfigurator, ListPaginationMapper;
    private IListFindByIdCategoryRepository $listFindByIdCategoryRepository;
    private Request $request;

    public function __construct(IListFindByIdCategoryRepository $listFindByIdCategoryRepository)
    {
        $this->listFindByIdCategoryRepository = $listFindByIdCategoryRepository;
    }

    public function listFindById(Request $request): Collection
    {
        $this->setRequest($request);
        return $this->listCollection();
    }

    private function listCollection(): Collection
    {
        $listCollection = $this->listFindByIdCategoryRepository->listFindById($this->request->id, $this->request->active);
        return $this->mapToDtoList($listCollection, CategoryDto::class);
    }
}
