<?php

namespace App\Repositories\Interfaces;

use App\Models\Telefone;
use Illuminate\Support\Collection;

interface TelephoneRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(Telefone $telefone): bool;
    public function update(int $id, Telefone $telefone): bool;
    public function getDDDAll(): Collection;
}
