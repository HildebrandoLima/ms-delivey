<?php

namespace App\Repositories\Interfaces;

use App\Models\Endereco;
use Illuminate\Support\Collection;

interface IAddressRepository {
    public function insert(Endereco $endereco): bool;
    public function update(int $id, Endereco $endereco): bool;
    public function delete(int $id): bool;
    public function getFederativeUnitAll(): Collection;
    public function getAddressAll(int $id): Collection;
}
