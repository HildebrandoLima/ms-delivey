<?php

namespace App\Infra\Database\Dao\Telephone;

use App\Http\Requests\User\UserRequest;
use App\Infra\Database\Config\DbBase;
use Illuminate\Support\Collection;

class ListTelephoneDb extends DbBase
{
    public function listDDDAll(): Collection
    {
        return $this->db
        ->table('ddd')
        ->select([
            'id as dddId',
            'ddd as ddd',
            'descricao as descricao'
        ])
        ->get();
    }

    public function listTelephoneAll(UserRequest $request): Collection
    {
        return $this->db
        ->table('telefone as t')
        ->join('ddd as d', 'd.id', '=', 't.ddd_id')
        ->select([
            't.id as telefoneId',
            't.numero as numero',
            't.tipo as tipo',
            'd.id as dddId',
            'd.ddd as ddd',
            'd.descricao as estado'
        ])
        ->where('t.usuario_id', $request->usuarioId)
        ->get();
    }
}
