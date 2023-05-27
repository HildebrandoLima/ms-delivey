<?php

namespace App\Repositories;

use App\Models\DDD;
use App\Models\Telefone;
use App\Repositories\Interfaces\ITelephoneRepository;
use Illuminate\Support\Collection;

class TelephoneRepository implements ITelephoneRepository {
    public function insert(Telefone $telefone): bool
    {
        return Telefone::query()->insert($telefone->toArray());
    }

    public function update(int $id, Telefone $telefone): bool
    {
        return Telefone::query()->where('id', $id)->update($telefone->toArray());
    }

    public function delete(int $id): bool
    {
        return Telefone::query()->where('id', $id)
        ->orWhere('usuario_id', $id)->delete();
    }

    public function getDDDAll(): Collection
    {
        return DDD::query()->select([
            'id as dddId',
            'ddd as ddd',
            'descricao as descricao'
        ])->get();
    }

    public function getTelephoneAll(int $id): Collection
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
        ])->where('telefone.usuario_id', $id)->get();
    }
}
