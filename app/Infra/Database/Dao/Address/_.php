<?php

namespace App\Infra\Database\Dao\Address;

use App\Http\Requests\Address\UserRequest;
use App\Infra\Database\Config\DbBase;
use Illuminate\Support\Collection;

class ListAddressDb extends DbBase
{
    public function listAddressAll(): Collection
    {
        return $this->db
        ->table('users as u')
        ->leftJoin('endereco as e', 'e.usuario_id', '=', 'u.id')
        ->select([
            'e.id as enderecoId',
            'e.logradouro as logradouro',
            'e.descricao as descricao',
            'e.bairro as bairro',
            'e.cidade as cidade',
            'e.cep as cep',
            'e.uf_id as ufId'
        ])
        ->orderBy('u.id')
        ->get();
    }

    public function listAddressFind(UserRequest $request): Collection
    {
        $query = $this->db
            ->table('users as u')
            ->leftJoin('endereco as e', 'e.usuario_id', '=', 'u.id')
            ->leftJoin('telefone as t', 't.usuario_id', '=', 'u.id')
            ->select([
                'u.id as usuarioId',
                'u.name as nome',
                'u.ativo as atividade',
                'u.genero as genero',
                'e.id as enderecoId',
                'e.logradouro as logradouro',
                'e.descricao as descricao',
                'e.bairro as bairro',
                'e.cidade as cidade',
                'e.cep as cep',
                'e.uf_id as ufId',
                't.ddd as ddd',
                't.numero as numero',
                't.tipo as tipo',
                't.ddd_id as dddId',
                'u.created_at as criadoEm',
                'u.updated_at as alteradoEm'
            ]);
        if (isset($request->usuarioId)):
            $query->where('u.id', $request->usuarioId);
        endif;

        if (isset($request->usuarioNome)):
            $query->where('u.name', 'like', '%' . $request->usuarioNome . '%');
        endif;
        return $query->get();
    }
}
