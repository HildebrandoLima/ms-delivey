<?php

namespace App\Support\Utils\QueryBuilder;

use App\Models\DDD;
use App\Models\Telefone;
use Illuminate\Database\Eloquent\Builder;

class TelephoneQuery {
    public function discagemDiretaDistanciaQuery(): Builder
    {
        return DDD::query()->select([
            'id as dddId',
            'ddd as ddd',
            'descricao as descricao'
        ]);
    }

    public function telephoneQuery(): Builder
    {
        return Telefone::query()
        ->join('ddd as d', 'd.id', '=', 'telefone.ddd_id')
        ->select([
            'telefone.id as telefoneId',
            'telefone.numero as numero',
            'telefone.tipo as tipo',
            'd.id as dddId',
            'd.ddd as ddd',
            'd.descricao as estado'
        ]);
    }
}
