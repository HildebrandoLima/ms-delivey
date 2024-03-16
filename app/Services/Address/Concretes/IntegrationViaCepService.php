<?php

namespace App\Services\Address\Concretes;

use App\Data\Infra\Integration\IntegrationViaCep;
use App\Services\Address\Abstracts\IIntegrationViaCepService;
use Illuminate\Support\Collection;

class IntegrationViaCepService implements IIntegrationViaCepService
{
    private IntegrationViaCep $integrationViaCep;

    public function __construct(IntegrationViaCep $integrationViaCep)
    {
        $this->integrationViaCep = $integrationViaCep;
    }

    public function integrationViaCep(string $cep): Collection
    {
        return $this->integrationViaCep->integrationViaCep($cep);   
    }
}
