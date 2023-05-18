<?php

namespace App\Repositories;

use App\Models\DDD;
use App\Models\Telefone;
use App\Repositories\Interfaces\ITelephoneRepository;
use App\Support\Utils\QueryBuilder\TelephoneQuery;
use Illuminate\Support\Collection;

class TelephoneRepository implements ITelephoneRepository {
    public function insert(Telefone $telefone): bool
    {
        return Telefone::query()->insert([
            'numero' => $telefone->numero,
            'tipo' => $telefone->tipo,
            'ddd_id' => $telefone->ddd_id,
            'usuario_id' => $telefone->usuario_id,
            'fornecedor_id' => $telefone->fornecedor_id,
            'created_at' => $telefone->created_at
        ]);
    }

    public function update(int $id, Telefone $telefone): bool
    {
        return Telefone::query()->where('id', $id)->update([
            'numero' => $telefone->numero,
            'tipo' => $telefone->tipo,
            'ddd_id' => $telefone->ddd_id,
            'usuario_id' => $telefone->usuario_id,
            'fornecedor_id' => $telefone->fornecedor_id,
            'updated_at' => $telefone->updated_at
        ]);
    }

    public function delete(int $id): bool
    {
        return Telefone::query()->where('id', $id)->delete();
    }

    public function getDDDAll(): Collection
    {
        $resulQuery = new TelephoneQuery();
        $query = $resulQuery->discagemDiretaDistanciaQuery();
        return $query->get();
    }

    public function getTelephoneAll(int $id): Collection
    {
        $resulQuery = new TelephoneQuery();
        $query = $resulQuery->telephoneQuery();
        return $query->where('telefone.usuario_id', $id)->get();
    }
}
