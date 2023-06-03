<?php

namespace App\Repositories;

use App\Models\Fornecedor;
use App\Repositories\Interfaces\IProviderRepository;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProviderRepository implements IProviderRepository {
    public function create(Fornecedor $fornecedor): int
    {
        $fornecedorId = Fornecedor::query()->create($fornecedor->toArray());
        return $fornecedorId->id;
    }

    public function update(int $id, Fornecedor $fornecedor): bool
    {
        return Fornecedor::query()->where('id', $id)->update($fornecedor->toArray());
    }

    public function delete(int $id): bool
    {
        return Fornecedor::query()->where('id', $id)->delete();
    }

    public function getAll(int $active): Collection
    {
        $query = $this->mapToQuery();
        $query->where('ativo', $active)->orderByDesc('id');
        return PaginationList::createFromPagination($query);
    }

    public function getFind(int $id, string $search, int $active): Collection
    {
        return $this->mapToQuery()
        ->where('ativo', $active)
        ->where('id', $id)
        ->orWhere('razao_social', 'like', $search)
        ->get();
    }

    private function mapToQuery(): Builder
    {
        return Fornecedor::query()->select([
            'id as fornecedorId',
            'razao_social as razao_social',
            'cnpj as cnpj',
            'ativo as ativo',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
