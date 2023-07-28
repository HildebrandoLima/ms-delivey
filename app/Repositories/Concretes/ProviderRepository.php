<?php

namespace App\Repositories\Concretes;

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

    public function update(Fornecedor $fornecedor): bool
    {
        return Fornecedor::query()->where('id', '=', $fornecedor->id)->update($fornecedor->toArray());
    }

    public function getAll(string $search, bool $active): Collection
    {
        $collection = $this->query()
        ->where(function($query) use ($search, $active) {
            if (!empty($search)):
                $query->where('fornecedor.razao_social', 'like', $search)->where('fornecedor.ativo', '=', $active);
            else:
                $query->where('fornecedor.ativo', '=', $active);
            endif;
        })->orderByDesc('fornecedor.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProviderMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function getOne(int $id, bool $active): Collection
    {
        $collect = $this->query()->where('fornecedor.ativo', '=', $active)
        ->where('fornecedor.id', '=', $id)->get()->toArray()[0];
        $collection = ProviderMapperDto::mapper($collect);
        return collect($collection);
    }

    public function getProdutosByProvider(int $id): array
    {
        return Fornecedor::query()->join('produto as p', 'p.fornecedor_id', '=', 'fornecedor.id')->where('fornecedor.id', $id)->get()->toArray();
    }

    private function query(): Builder
    {
        return Fornecedor::with('endereco')->with('telefone');
    }
}
