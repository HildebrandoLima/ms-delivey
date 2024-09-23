<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Models\User;
use App\Support\Queries\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListAllUserRepository implements IListAllUserRepository
{
    public function hasPagination(string $search, bool $active): LengthAwarePaginator
    {
        return $this->query($search, $active)->paginate(10);
    }

    public function noPagination(string $search, bool $active): Collection
    {
        return $this->query($search, $active)->get();
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
}
