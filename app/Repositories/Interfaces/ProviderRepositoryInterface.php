<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\ProviderDto;
use App\Models\Fornecedor;
use Illuminate\Support\Collection;

interface ProviderRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(ProviderDto $providerDto): Fornecedor;
    public function update(int $id, ProviderDto $providerDto): bool;
    public function getAll(int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
