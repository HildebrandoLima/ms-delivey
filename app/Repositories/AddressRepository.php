<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Repositories\Interfaces\IAddressRepository;
use App\Support\Utils\QueryBuilder\AddressQuery;
use Illuminate\Support\Collection;

class AddressRepository implements IAddressRepository {
    public function insert(Endereco $endereco): bool
    {
        return Endereco::query()->insert([
            'logradouro' => $endereco->logradouro,
            'descricao' => $endereco->descricao,
            'bairro' => $endereco->bairro,
            'cidade' => $endereco->cidade,
            'cep' => $endereco->cep,
            'uf_id' => $endereco->uf_id,
            'usuario_id' => $endereco->usuario_id,
            'fornecedor_id' => $endereco->fornecedor_id,
            'created_at' => $endereco->created_at
        ]);
    }

    public function update(int $id, Endereco $endereco): bool
    {
        return Endereco::query()->where('id', $id)->update([
            'logradouro' => $endereco->logradouro,
            'descricao' => $endereco->descricao,
            'bairro' => $endereco->bairro,
            'cidade' => $endereco->cidade,
            'cep' => $endereco->cep,
            'uf_id' => $endereco->uf_id,
            'usuario_id' => $endereco->usuario_id,
            'fornecedor_id' => $endereco->fornecedor_id,
            'updated_at' => $endereco->updated_at
        ]);
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
