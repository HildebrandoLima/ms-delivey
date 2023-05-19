<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Repositories\Interfaces\IAddressRepository;
use App\Support\Utils\Date\DateFormat;
use App\Support\Utils\QueryBuilder\AddressQuery;
use Illuminate\Support\Collection;

class AddressRepository implements IAddressRepository {
    public function insert(Endereco $endereco): bool
    {
        $resulQuery = new DateFormat();
        $endereco = $resulQuery->dateFormatDefault($endereco->toArray());
        return Endereco::query()->insert($endereco);
    }

    public function update(int $id, Endereco $endereco): bool
    {
        $resulQuery = new DateFormat();
        $endereco = $resulQuery->dateFormatDefault($endereco->toArray());
        return Endereco::query()->where('id', $id)->update($endereco);
    }

    public function delete(int $id): bool
    {
        return Endereco::query()->where('id', $id)->delete();
    }

    public function getFederativeUnitAll(): Collection
    {
        $resulQuery = new AddressQuery();
        $query = $resulQuery->unidadeFederativaQuery();
        return $query->get();
    }

    public function getAddressAll(int $id): Collection
    {
        $resulQuery = new AddressQuery();
        $query = $resulQuery->addressQuery();
        return $query->where('endereco.usuario_id', $id)->get();
    }
}
