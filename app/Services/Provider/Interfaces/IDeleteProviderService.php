<?php

namespace App\Services\Provider\Interfaces;

interface IDeleteProviderService
{
    public function deleteProvider(int $id): bool;
}
