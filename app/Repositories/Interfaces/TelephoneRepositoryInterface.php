<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\TelephoneDto;
use Illuminate\Support\Collection;

interface TelephoneRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(TelephoneDto $telephoneDto): bool;
    public function update(int $id, TelephoneDto $telephoneDto): bool;
    public function getDDDAll(): Collection;
}
