<?php

namespace App\Infra\Database\Dao\Provider;

use App\Http\Requests\Provider\ProviderRequest;
use App\Infra\Database\Config\DbBase;
use Illuminate\Support\Collection;

class ListProviderDb extends DbBase
{
    public function listProviderAll(): Collection
    {
        return collect($this->db
            ->table('fornecedor')
            ->select([
                'id as fornecedorId',
                'nome as nome',
                'cnpj as cnpj',
                'created_at as criadoEm',
                'updated_at as alteradoEm'
            ])
            ->orderBy('id')->paginate(10));
    }

    public function listProviderFind(ProviderRequest $request): Collection
    {
        $query = $this->db
            ->table('fornecedor')
            ->select([
                'id as fornecedorId',
                'nome as nome',
                'cnpj as cnpj',
                'id as enderecoId',
                'created_at as criadoEm',
                'updated_at as alteradoEm'
            ]);
        if (isset($request->fornecedorId)):
            $query->where('id', $request->fornecedorId);
        endif;

        if (isset($request->fornecedorNome)):
            $query->where('nome', 'like', '%' . $request->fornecedorNome . '%');
        endif;
        return $query->get();
    }
}
