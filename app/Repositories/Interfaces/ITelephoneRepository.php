<?php

namespace App\Repositories\Interfaces;

use App\Models\Telefone;
use Illuminate\Support\Collection;

interface ITelephoneRepository {
    public function create(Telefone $telefone): bool;
    public function update(int $id, Telefone $telefone): bool;
    public function delete(int $id): bool;
    public function enableDisable(int $id, int $active): bool;
    public function getDDDAll(): Collection;
    public function getTelephoneAll(int $id, int $active): Collection;
}
