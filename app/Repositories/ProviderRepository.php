<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Repositories\Interfaces\IProviderRepository;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProviderRepository implements IProviderRepository {
    public function insert(Fornecedor $fornecedor): int
    {
        return Fornecedor::query()->insertGetId($fornecedor->toArray());
    }

    public function update(int $id, Fornecedor $fornecedor): bool
    {
        return Fornecedor::query()->where('id', $id)->update($fornecedor->toArray());
    }

    public function delete(int $id): bool
    {
        return Fornecedor::query()->where('id', $id)->delete();
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        $query = $this->mapToQuery();
        $query->orderByDesc('id');
        if (isset ($pagination->page) && isset ($pagination->perPage)):
            return PaginationList::createFromPagination($query, $pagination);
        endif;
        return $query->where('nome', 'like', $search)
            ->orWhere('cnpj', 'like', $search)->get();
    }

    public function getFind(int $id): Collection
    {
        return $this->mapToQuery()->where('id', $id)->get();
    }

    private function mapToQuery(): Builder
    {
        return Fornecedor::query()->select([
            'id as fornecedorId',
            'nome as nome',
            'cnpj as cnpj',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
