<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Repositories\Interfaces\IProviderRepository;
use App\Support\Utils\Date\DateFormat;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use App\Support\Utils\QueryBuilder\ProviderQuery;
use Illuminate\Support\Collection;

class ProviderRepository implements IProviderRepository {
    public function insert(Fornecedor $fornecedor): int
    {
        $resulQuery = new DateFormat();
        $fornecedor = $resulQuery->dateFormatDefault($fornecedor->toArray());
        return Fornecedor::query()->insertGetId($fornecedor);
    }

    public function update(int $id, Fornecedor $fornecedor): bool
    {
        $resulQuery = new DateFormat();
        $fornecedor = $resulQuery->dateFormatDefault($fornecedor->toArray());
        return Fornecedor::query()->where('id', $id)->update($fornecedor);
    }

    public function delete(int $id): bool
    {
        $provider = Fornecedor::query()->where('id', $id)->delete();
        $address = Endereco::query()->where('fornecedor_id', $id)->delete();
        $telephone = Telefone::query()->where('fornecedor_id', $id)->delete();
        if (!$provider and !$address and !$telephone):
            return false;
        endif;
        return true;
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        $resulQuery = new ProviderQuery();
        $query = $resulQuery->providerQuery();
        $query->orderBy('id');
        if (isset ($pagination->page) && isset ($pagination->perPage)):
            return PaginationList::createFromPagination($query, $pagination);
        endif;
        return $query->where('nome', 'like', $search)
            ->orWhere('cnpj', 'like', $search)->get();
    }

    public function getFind(int $id): Collection
    {
        $resulQuery = new ProviderQuery();
        $query = $resulQuery->providerQuery();
        return $query->where('id', $id)->get();
    }
}
