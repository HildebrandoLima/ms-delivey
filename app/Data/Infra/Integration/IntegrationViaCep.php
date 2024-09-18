<?php

namespace App\Data\Infra\Integration;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class IntegrationViaCep
{
    public function integrationViaCep(string $cep): ?Collection
    {
        $response = Http::get('https://viacep.com.br/ws/' . $cep . '/json')->json();

        return optional($response) ? collect($this->treatObject($response)) : null;
    }

    private function treatObject(array $data): array
    {
        unset($data['ibge']);
        unset($data['gia']);
        unset($data['ddd']);
        unset($data['siafi']);
        $data['cidade'] = $data['localidade'];
        unset($data['localidade']);
        return $data;
    }
}
