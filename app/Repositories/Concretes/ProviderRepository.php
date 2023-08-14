<?php

namespace App\Repositories\Concretes;

use App\Dtos\ProviderDto;
use App\Models\Fornecedor;
use App\Repositories\Abstracts\IProviderRepository;
use App\Support\MapperEntity\EntityPerson;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\DateFormat\DateFormat;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Support\Collection;

class ProviderRepository implements IProviderRepository
{
    public function readAll(string $search, bool $filter): Collection
    {
        $collection = Fornecedor::with('endereco')->with('telefone')
        ->where(function($query) use ($search, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search)):
                $query->where('fornecedor.razao_social', 'like', $search);
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('fornecedor.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = Fornecedor::with('endereco')->with('telefone')
        ->where(function($query) use ($filter) {
            QueryFilter::getQueryFilter($query, $filter);
        })->where('fornecedor.id', '=', $id)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return collect($collection);
    }

    private function map(array $data): ProviderDto
    {
        $provider = new ProviderDto();
        $provider->fornecedorId = $data['id'];
        $provider->razaoSocial = $data['razao_social'];
        $provider->cnpj = $data['cnpj'];
        $provider->email = $data['email'];
        $provider->dataFundacao = $data['data_fundacao'];
        $provider->ativo = $data['ativo'];
        $provider->criadoEm = DateFormat::dateFormat($data['created_at']);
        $provider->alteradoEm = DateFormat::dateFormat($data['updated_at']);
        $provider->enderecos = EntityPerson::addrres($data['endereco']);
        $provider->telefones = EntityPerson::telephone($data['telefone']);
        return $provider;
    }

    //public function getProdutosByProvider(int $id): array
   //{
        //return Fornecedor::query()->join('produto as p', 'p.fornecedor_id', '=', 'fornecedor.id')->where('fornecedor.id', $id)->get()->toArray();
    //}
}
