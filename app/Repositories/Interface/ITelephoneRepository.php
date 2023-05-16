<?php

namespace App\Repositories\Interface;

use App\Models\Telefone;
use Illuminate\Support\Collection;

interface ITelephoneRepository {
    public function insert(Telefone $telefone): bool;
    public function update(int $id, Telefone $telefone): bool;
    public function delete(int $id): bool;
    public function getDDDAll(): Collection;
    public function getTelephoneAll(int $id): Collection;
}
