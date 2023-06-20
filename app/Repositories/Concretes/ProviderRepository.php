<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\ProviderDto;
use App\DataTransferObjects\MappersDtos\ProviderMapperDto;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Support\Utils\Pagination\PaginationList;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProviderRepository implements ProviderRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Fornecedor::query()->where('id', '=', $id)->update(['ativo' => $active]);
    }

    public function emailVerifiedAt(int $id, int $active): bool
    {
        return Fornecedor::query()->where('ativo', '=', $active)->where('id', '=', $id)->update(['email_verified_at' => Carbon::now()]);
    }

    public function create(ProviderDto $providerDto): Fornecedor
    {
        dd($providerDto);
        return Fornecedor::query()->create((array)$providerDto);
    }

    public function update(int $id, ProviderDto $providerDto): bool
    {
        return Fornecedor::query()->where('id', '=', $id)->update((array)$providerDto);
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
