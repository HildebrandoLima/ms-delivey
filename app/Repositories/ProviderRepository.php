<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Repositories\Interfaces\IProviderRepository;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use App\Support\Utils\QueryBuilder\ProviderQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProviderRepository implements IProviderRepository {
    public function insert(Fornecedor $fornecedor): int
    {
        return Fornecedor::query()->insertGetId([
            'nome' => $fornecedor->nome,
            'cnpj' => $fornecedor->cnpj,
            'email' => $fornecedor->email,
            'ativo' => $fornecedor->ativo,
            'data_fundacao' => $fornecedor->data_fundacao,
            'created_at' => $fornecedor->created_at
        ]);
    }

    public function update(int $id, Fornecedor $fornecedor): bool
    {
        return Fornecedor::query()->where('id', $id)->update([
            'nome' => $fornecedor->nome,
            'cnpj' => $fornecedor->cnpj,
            'email' => $fornecedor->email,
            'ativo' => $fornecedor->ativo,
            'data_fundacao' => $fornecedor->data_fundacao,
            'updated_at' => $fornecedor->updated_at
        ]);
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
