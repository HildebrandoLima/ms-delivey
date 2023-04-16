<?php

namespace App\Infra\Database\Dao\Address;

use App\Http\Requests\User\UserRequest;
use App\Infra\Database\Config\DbBase;
use Illuminate\Support\Collection;

class ListAddressDb extends DbBase
{
    public function listFederativeUnitAll(): Collection
    {
        return $this->db
        ->table('unidade_federativa')
        ->select([
            'id as ufId',
            'uf as uf',
            'descricao as descricao'
        ])
        ->get();
    }

    public function listAddressAll(UserRequest $request): Collection
    {
        return $this->db
        ->table('endereco as e')
        ->join('unidade_federativa as uf', 'uf.id', '=', 'e.uf_id')
        ->select([
            'e.id as enderecoId',
            'e.logradouro as logradouro',
            'e.descricao as descricao',
            'e.bairro as bairro',
            'e.cidade as cidade',
            'e.cep as cep',
            'e.created_at as criadoEm',
            'e.updated_at as alteradoEm',
            'uf.id as ufId',
            'uf.uf as uf',
            'uf.descricao as estado'
        ])
        ->where('e.usuario_id', $request->usuarioId)
        ->get();
    }
}
