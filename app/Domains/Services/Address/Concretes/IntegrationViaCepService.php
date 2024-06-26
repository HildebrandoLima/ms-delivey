<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Infra\Integration\IntegrationViaCep;
use App\Domains\Services\Address\Abstracts\IIntegrationViaCepService;
use Illuminate\Support\Collection;

class IntegrationViaCepService implements IIntegrationViaCepService
{
    private IntegrationViaCep $integrationViaCep;

    public function __construct(IntegrationViaCep $integrationViaCep)
    {
        $this->integrationViaCep = $integrationViaCep;
    }

    public function integrationViaCep(string $cep): Collection|null
    {
        return $this->integrationViaCep->integrationViaCep($cep);   
    }
}
