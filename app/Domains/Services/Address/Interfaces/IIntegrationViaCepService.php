<?php

namespace App\Domains\Services\Address\Interfaces;

use Illuminate\Support\Collection;

interface IIntegrationViaCepService
{
    public function integration(string $cep): ?Collection;
}
