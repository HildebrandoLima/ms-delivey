<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Models\UnidadeFederativa;
use App\Repositories\Interfaces\IAddressRepository;
use Illuminate\Support\Collection;

class AddressRepository implements IAddressRepository {
    public function create(Endereco $endereco): bool
    {
        Endereco::query()->create($endereco->toArray());
        return true;
    }

    public function update(int $id, Endereco $endereco): bool
    {
        return Endereco::query()->where('id', $id)->update($endereco->toArray());
    }

    public function delete(int $id): bool
    {
        return Endereco::query()->where('id', $id)
        ->orWhere(function ($query) use ($id) {
            $query->where('usuario_id', $id)
                ->orWhere(function ($query) use ($id) {
                    $query->where('fornecedor_id', $id);
                });
        })->delete();
    }

    public function getFederativeUnitAll(): Collection
    {
        return UnidadeFederativa::query()->select([
            'id as ufId',
            'uf as uf',
            'descricao as descricao'
        ])->get();
    }

    public function getAddressAll(int $id, int $active): Collection
    {
        return Endereco::query()
        ->join('unidade_federativa as uf', 'uf.id', '=', 'endereco.uf_id')
        ->select([
            'endereco.id as enderecoId',
            'endereco.logradouro as logradouro',
            'endereco.descricao as descricao',
            'endereco.bairro as bairro',
            'endereco.cidade as cidade',
            'endereco.cep as cep',
            'endereco.created_at as criadoEm',
            'endereco.updated_at as alteradoEm',
            'uf.id as ufId',
            'uf.uf as uf',
            'uf.descricao as estado'
        ])
        ->where('endereco.usuario_id', $id)
        ->where('ativo', $active)->get();
    }
}
