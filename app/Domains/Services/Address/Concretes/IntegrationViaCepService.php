<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Infra\Integration\IntegrationViaCep;
use App\Domains\Services\Address\Interfaces\IIntegrationViaCepService;
use Illuminate\Support\Collection;

class IntegrationViaCepService implements IIntegrationViaCepService
{
    private IntegrationViaCep $integrationViaCep;

    public function __construct(IntegrationViaCep $integrationViaCep)
    {
        $this->integrationViaCep = $integrationViaCep;
    }

    public function integration(string $cep): ?Collection
    {
        return $this->integrationViaCep->integrationViaCep($cep);   
    }
}
