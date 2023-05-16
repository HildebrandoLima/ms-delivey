<?php

namespace App\Repositories\Interface;

use App\Models\Endereco;
use Illuminate\Support\Collection;

interface IAddressRepository {
    public function insert(Endereco $endereco): bool;
    public function update(int $id, Endereco $endereco): bool;
    public function delete(int $id): bool;
    public function getAllFederativeUnit(): Collection;
    public function getAllAddress(int $id): Collection;
}
