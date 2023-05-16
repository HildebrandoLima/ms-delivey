<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProviderRepository {
    public function insert(Fornecedor $provider): int
    {
        return Fornecedor::query()->insertGetId([
            'nome' => $provider->nome,
            'cnpj' => $provider->cnpj,
            'email' => $provider->email,
            'ativo' => $provider->ativo,
            'data_fundacao' => $provider->data_fundacao,
            'created_at' => $provider->created_at
        ]);
    }

    public function update(int $id, Fornecedor $provider): bool
    {
        return Fornecedor::query()->where('id', $id)->update([
            'nome' => $provider->nome,
            'cnpj' => $provider->cnpj,
            'email' => $provider->email,
            'ativo' => $provider->ativo,
            'data_fundacao' => $provider->data_fundacao,
            'updated_at' => $provider->updated_at
        ]);
    }

    public function delete(int $id): bool
    {
        $provider = Fornecedor::query()->where('id', $id)->delete();
        $address = Endereco::query()->where('fornecedor_id', $id)->delete();
        $telephone = Telefone::query()->where('fornecedor_id', $id)->delete();
        if (!$provider and !$address and !$telephone):
            return false;
        endif;
        return true;
    }

    public function getAll(Request $request, string $search): Collection
    {
        $query = $this->mapToCollection();
        $query->orderBy('id');
        if (isset($request->search)):
            $query->where('nome', 'like', $search)
                ->orWhere('cnpj', $request->search);
            return $query->get();
        endif;
        return PaginationList::createFromPagination($query, $request);
    }

    public function getFind(int $id): Collection
    {
        $query = $this->mapToCollection();
        $query->where('id', $id);
        return $query->get();
    }

    private function mapToCollection(): Builder
    {
        return Fornecedor::query()->select([
            'id as fornecedorId',
            'nome as nome',
            'cnpj as cnpj',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
