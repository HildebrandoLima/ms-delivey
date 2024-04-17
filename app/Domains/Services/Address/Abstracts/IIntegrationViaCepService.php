<?php

namespace App\Domains\Services\Address\Abstracts;

use Illuminate\Support\Collection;

interface IIntegrationViaCepService
{
    public function integrationViaCep(string $cep): Collection|null;
}
