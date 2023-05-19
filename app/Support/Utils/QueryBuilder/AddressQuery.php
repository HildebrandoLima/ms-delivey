<?php

namespace App\Support\Utils\QueryBuilder;

use App\Models\Endereco;
use App\Models\UnidadeFederativa;
use Illuminate\Database\Eloquent\Builder;

class AddressQuery {
    public function unidadeFederativaQuery(): Builder
    {
        return UnidadeFederativa::query()->select([
            'id as ufId',
            'uf as uf',
            'descricao as descricao'
        ]);
    }

    public function addressQuery(): Builder
    {
        return Endereco::query()
        ->join('unidade_federativa as uf', 'uf.id', '=', 'endereco.uf_id')
        ->select([
            'endereco.id as enderecoId',
            'endereco.logradouro as logradouro',
            'endereco.descricao as descricao',
            'endereco.bairro as bairro',
            'endereco.cidade as cidade',
            'endereco.cep as cep',
            'endereco.created_at as criadoEm',
            'endereco.updated_at as alteradoEm',
            'uf.id as ufId',
            'uf.uf as uf',
            'uf.descricao as estado'
        ]);
    }
}
