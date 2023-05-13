<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Models\UnidadeFederativa;
use Illuminate\Support\Collection;

class AddressRepository {
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
            'ativo' => $endereco->ativo,
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
            'ativo' => $endereco->ativo,
            'updated_at' => $endereco->updated_at
        ]);
    }

    public function delete(int $id): bool
    {
        return Endereco::query()->where('id', $id)->delete();
    }

    public function getAllFederativeUnit(): Collection
    {
        return UnidadeFederativa::query()->select([
            'id as ufId',
            'uf as uf',
            'descricao as descricao'
        ])->get();
    }

    public function getAllAddress(int $id): Collection
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
        ->get();
    }
}
