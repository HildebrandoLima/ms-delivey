<?php

namespace App\Repositories\Interfaces;

use App\Models\Telefone;
use Illuminate\Support\Collection;

interface TelephoneRepositoryInterface
{
    public function enableDisable(int $id, bool $active): bool;
    public function create(Telefone $telefone): bool;
    public function update(Telefone $telefone): bool;
    public function getDDDAll(): Collection;
}
