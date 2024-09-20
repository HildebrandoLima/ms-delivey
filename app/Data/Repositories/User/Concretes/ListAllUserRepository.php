<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Domains\Dtos\UserDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\User;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginatedList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListAllUserRepository implements IListAllUserRepository
{
    use AutoMapper;

    public function hasPagination(string $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->paginate(10);
        foreach ($collection->items() as $key => $value) {
          $collection[$key] = $this->map($value->toArray());
        }
        return PaginatedList::createFromPagination($collection);
    }

    public function noPagination(string $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->get();
        foreach ($collection->toArray() as $key => $value) {
            $collection[$key] = $this->map($value);
        }
        return $collection;
    }

    private function query(string $search, bool $active): Builder
    {
        return User::with('endereco')->with('telefone')
        ->where(function($query) use ($search, $active) {

            QueryFilter::getQueryFilter($query, $active);

            if (!empty($search)) {
                $query->where('users.nome', 'like', $search);
            }
        })->orderByDesc('users.id');
    }

    private function map(array $data): UserDto
    {
        return $this->mapper($data, UserDto::class);
    }
}
