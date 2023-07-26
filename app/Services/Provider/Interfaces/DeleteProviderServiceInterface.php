<?php

namespace App\Services\Provider\Interfaces;

interface DeleteProviderServiceInterface
{
    public function deleteProvider(int $id, bool $active): bool;
}
