<?php

namespace App\Repositories;

use App\Models\Telefone;
use App\Repositories\Interfaces\ITelephoneRepository;
use App\Support\Utils\Date\DateFormat;
use App\Support\Utils\QueryBuilder\TelephoneQuery;
use Illuminate\Support\Collection;

class TelephoneRepository implements ITelephoneRepository {
    public function insert(Telefone $telefone): bool
    {
        $resulQuery = new DateFormat();
        $telefone = $resulQuery->dateFormatDefault($telefone->toArray());
        return Telefone::query()->insert($telefone);
    }

    public function update(int $id, Telefone $telefone): bool
    {
        $resulQuery = new DateFormat();
        $telefone = $resulQuery->dateFormatDefault($telefone->toArray());
        return Telefone::query()->where('id', $id)->update($telefone);
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
