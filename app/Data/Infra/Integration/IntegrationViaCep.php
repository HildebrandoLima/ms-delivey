<?php

namespace App\Data\Infra\Integration;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class IntegrationViaCep
{
    public function integrationViaCep(string $cep): Collection
    {
        $response = Http::get('https://viacep.com.br/ws/' . $cep . '/json');
        $data = json_decode($response->getBody(), true);
        $data = $this->treatObject($data);
        return collect($data);
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
