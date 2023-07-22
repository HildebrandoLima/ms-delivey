<?php

namespace App\Repositories\Concretes;

use App\Models\DDD;
use App\Models\Telefone;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use Illuminate\Support\Collection;

class TelephoneRepository implements TelephoneRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Telefone::query()->where('id', '=', $id)
        ->orWhere(function ($query) use ($id) {
            $query->where('usuario_id', '=', $id)
                ->orWhere(function ($query) use ($id) {
                    $query->where('fornecedor_id', '=', $id);
                });
        })->update(['ativo' => $active]);
    }

    public function create(Telefone $telefone): bool
    {
        Telefone::query()->create($telefone->toArray());
        return true;
    }

    public function update(int $id, Telefone $telefone): bool
    {
        return Telefone::query()->where('id', '=', $id)->update($telefone->toArray());
    }

    public function getDDDAll(): Collection
    {
        return DDD::query()->get();
    }
}
