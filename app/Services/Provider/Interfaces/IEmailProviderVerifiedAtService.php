<?php

namespace App\Services\Provider\Interfaces;

interface IEmailProviderVerifiedAtService
{
    public function emailVerifiedAt(int $id, int $active): bool;
}
