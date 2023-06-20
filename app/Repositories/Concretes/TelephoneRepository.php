<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\TelephoneDto;
use App\Models\DDD;
use App\Models\Telefone;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use Illuminate\Support\Collection;

class TelephoneRepository implements TelephoneRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Telefone::query()->where('id', $id)
        ->orWhere(function ($query) use ($id) {
            $query->where('usuario_id', $id)
                ->orWhere(function ($query) use ($id) {
                    $query->where('fornecedor_id', $id);
                });
        })->update(['ativo' => $active]);
    }

    public function create(TelephoneDto $telephoneDto): bool
    {
        Telefone::query()->create((array)$telephoneDto);
        return true;
    }

    public function update(int $id, TelephoneDto $telephoneDto): bool
    {
        return Telefone::query()->where('id', '=', $id)->update((array)$telephoneDto);
    }

    public function getDDDAll(): Collection
    {
        return DDD::query()->get();
    }
}
