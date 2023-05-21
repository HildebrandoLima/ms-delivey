<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Repositories\Interfaces\IProductRepository;
use App\Support\Utils\Date\DateFormat;
use App\Support\Utils\Pagination\Pagination;
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
        return true;
    }

    public function delete(int $id): bool
    {
        return true;
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        return collect();
    }

    public function getFind(int $id): Collection
    {
       return collect();
    }
}
