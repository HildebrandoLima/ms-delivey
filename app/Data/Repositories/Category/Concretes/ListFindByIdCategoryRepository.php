<?php

namespace App\Data\Repositories\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IListFindByIdCategoryRepository;
use App\Domains\Dtos\CategoryDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Categoria;
use App\Support\Queries\QueryFilter;
use Illuminate\Support\Collection;

class ListFindByIdCategoryRepository implements IListFindByIdCategoryRepository
{
    use AutoMapper;

    public function listFindById(int $id, bool $active): Collection
    {
        $collection = $this->query($id, $active);
        foreach ($collection->toArray() as $key => $value) {
            $collection[$key] = $this->map($value);
        }
        return $collection;
    }

    private function query(int $id, bool $active): Collection
    {
        return Categoria::query()
        ->where(function($query) use ($active) {
            QueryFilter::getQueryFilter($query, $active);
        })->where('id', '=', $id)->get();
    }

    private function map(array $data): CategoryDto
    {
        return $this->mapper($data, CategoryDto::class);
    }
}
