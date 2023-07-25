<?php

namespace App\Repositories\Interfaces;

use App\Models\Endereco;
use Illuminate\Support\Collection;

interface AddressRepositoryInterface
{
    public function enableDisable(int $id, bool $active): bool;
    public function create(Endereco $endereco): bool;
    public function update(Endereco $endereco): bool;
    public function getFederativeUnitAll(): Collection;
}
