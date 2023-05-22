<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Repositories\Interfaces\IProductRepository;
use App\Support\Utils\Date\DateFormat;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use App\Support\Utils\QueryBuilder\ProductQuery;
use Illuminate\Support\Collection;

class ProductRepository implements IProductRepository {
    public function insert(Produto $produto): int
    {
        $resulQuery = new DateFormat();
        $produto = $resulQuery->dateFormatDefault($produto->toArray());
        return Produto::query()->insertGetId($produto);
    }

    public function update(int $id, Produto $produto): bool
    {
        $resulQuery = new DateFormat();
        $produto = $resulQuery->dateFormatDefault($produto->toArray());
        return Produto::query()->where('id', $id)->update($produto);
    }

    public function delete(int $id): bool
    {
        return Produto::query()->where('id', $id)->delete();
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        $resulQuery = new ProductQuery();
        $query = $resulQuery->productQuery();
        $query->orderBy('id');
        if (isset ($pagination->page) && isset ($pagination->perPage)):
            return PaginationList::createFromPagination($query, $pagination);
        endif;
        return $query->where('nome', 'like', $search)->get();
    }

    public function getFind(int $id): Collection
    {
        $resulQuery = new ProductQuery();
        $query = $resulQuery->productQuery();
        $query->where('id', $id);
        return $query->get();
    }
}
