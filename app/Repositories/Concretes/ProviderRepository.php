<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\ProviderDto;
use App\DataTransferObjects\MappersDtos\ProviderMapperDto;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProviderRepository implements ProviderRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Fornecedor::query()->where('id', '=', $id)->update(['ativo' => $active]);
    }

    public function create(Fornecedor $fornecedor): int
    {
        return Fornecedor::query()->create($fornecedor->toArray())->orderBy('id', 'desc')->first()->id;
    }

    public function update(int $id, Fornecedor $fornecedor): bool
    {
        return Fornecedor::query()->where('id', '=', $id)->update($fornecedor->toArray());
    }

    public function getAll(int $active): Collection
    {
        $collection = $this->mapToQuery()->where('fornecedor.ativo', '=', $active)->orderByDesc('fornecedor.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProviderMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function getOne(int $id, string $search, int $active): Collection
    {
        $collect = $this->mapToQuery()->where('fornecedor.ativo', '=', $active)->where('fornecedor.id', '=', $id)
        ->orWhere('fornecedor.razao_social', 'like', $search)->get()->toArray()[0];
        $collection = ProviderMapperDto::mapper($collect);
        return collect($collection);
    }

    private function mapToQuery(): Builder
    {
        return Fornecedor::with('endereco')->with('telefone');
    }
}
