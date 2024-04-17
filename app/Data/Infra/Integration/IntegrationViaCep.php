<?php

namespace App\Data\Infra\Integration;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class IntegrationViaCep
{
    public function integrationViaCep(string $cep): Collection|null
    {
        $response = Http::get('https://viacep.com.br/ws/' . $cep . '/json')->json();

        if (!is_null($response)):
            return collect($this->treatObject($response));
        endif;
        return null;
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
