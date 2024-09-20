<?php

namespace App\Data\Repositories\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IListFindByIdProductRepository;
use App\Domains\Dtos\ProductDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Produto;
use App\Support\Queries\QueryFilter;
use Illuminate\Support\Collection;

class ListFindByIdProductRepository implements IListFindByIdProductRepository
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
        return Produto::query()->with('imagem')
        ->where(function($query) use ($id, $active) {

            QueryFilter::getQueryFilter($query, $active);

        })->where('produto.id', '=', $id)->get();
    }

    private function map(array $data): ProductDto
    {
        return $this->mapper($data, ProductDto::class);
    }
}
