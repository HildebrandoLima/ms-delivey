<?php

namespace App\Domains\Traits\Dtos;

use App\Support\Utils\Pagination\Concrete\PaginatedList;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait ListPaginationMapper
{
    use AutoMapper;

    protected function mapToDtoList(LengthAwarePaginator|Collection $collection, string $dtoClass): Collection
    {
        foreach ($collection instanceof LengthAwarePaginator ? $collection->items() : $collection as $key => $value) {
            $collection[$key] = $this->mapTo($value->toArray(), $dtoClass);
        }
    
        return $collection instanceof LengthAwarePaginator 
            ? PaginatedList::createFromPagination($collection) 
            : $collection;
    }
}
