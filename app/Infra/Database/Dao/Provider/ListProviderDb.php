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
            ->table('fornecedor as f')
            ->leftJoin('endereco as e', 'e.fornecedor_id', '=', 'f.id')
            ->leftJoin('unidade_federativa as uf', 'uf.id', '=', 'e.uf_id')
            ->leftJoin('telefone as t', 't.fornecedor_id', '=', 'f.id')
            ->leftJoin('ddd as d', 'd.id', '=', 't.ddd_id')
            ->select([
                'f.id as fornecedorId',
                'f.nome as nome',
                'f.cnpj as cnpj',
                'e.id as enderecoId',
                'e.logradouro as logradouro',
                'e.descricao as descricao',
                'e.bairro as bairro',
                'e.cidade as cidade',
                'e.cep as cep',
                'uf.id as ufId',
                'uf.uf as uf',
                'uf.descricao as descricaoUF',
                't.ddd as ddd',
                't.numero as numero',
                't.tipo as tipo',
                'd.id as dddId',
                'd.ddd as ddd',
                'd.descricao as descricaoDDD',
                'f.created_at as criadoEm',
                'f.updated_at as alteradoEm'
            ])
            ->orderBy('f.id')->paginate(10));
    }

    public function listProviderFind(ProviderRequest $request): Collection
    {
        $query = $this->db
            ->table('fornecedor as f')
            ->leftJoin('endereco as e', 'e.fornecedor_id', '=', 'f.id')
            ->leftJoin('unidade_federativa as uf', 'uf.id', '=', 'e.uf_id')
            ->leftJoin('telefone as t', 't.fornecedor_id', '=', 'f.id')
            ->leftJoin('ddd as d', 'd.id', '=', 't.ddd_id')
            ->select([
                'f.id as fornecedorId',
                'f.nome as nome',
                'f.cnpj as cnpj',
                'e.id as enderecoId',
                'e.logradouro as logradouro',
                'e.descricao as descricao',
                'e.bairro as bairro',
                'e.cidade as cidade',
                'e.cep as cep',
                'uf.id as ufId',
                'uf.uf as uf',
                'uf.descricao as descricaoUF',
                't.ddd as ddd',
                't.numero as numero',
                't.tipo as tipo',
                'd.id as dddId',
                'd.ddd as ddd',
                'd.descricao as descricaoDDD',
                'f.created_at as criadoEm',
                'f.updated_at as alteradoEm'
            ]);
        if (isset($request->fornecedorId)):
            $query->where('f.id', $request->fornecedorId);
        endif;

        if (isset($request->fornecedorNome)):
            $query->where('f.nome', 'like', '%' . $request->fornecedorNome . '%');
        endif;
        return $query->get();
    }
}
