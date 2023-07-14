<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\AddressDto;
use App\Models\Endereco;
use App\Models\UnidadeFederativa;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use Illuminate\Support\Collection;

class AddressRepository implements AddressRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Endereco::query()->where('id', '=', $id)
        ->orWhere(function ($query) use ($id) {
            $query->where('usuario_id', '=', $id)
                ->orWhere(function ($query) use ($id) {
                    $query->where('fornecedor_id', '=', $id);
                });
        })->update(['ativo' => $active]);
    }

    public function create(Endereco $endereco): bool
    {
        Endereco::query()->create($endereco->toArray());
        return true;
    }

    public function update(int $id, AddressDto $addressDto): bool
    {
        return Endereco::query()->where('id', '=', $id)->update((array)$addressDto);
    }

    public function getFederativeUnitAll(): Collection
    {
        return UnidadeFederativa::query()->get();
    }
}
