<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListFindByIdUserRepository;
use App\Models\User;
use App\Support\Queries\QueryFilter;
use Illuminate\Support\Collection;

class ListFindByIdUserRepository implements IListFindByIdUserRepository
{
    public function listFindById(int $id, bool $active): Collection
    {
        return User::with('endereco')->with('telefone')
        ->where(function($query) use ($id, $active) {
            QueryFilter::getQueryFilter($query, $active);
        })->where('users.id', $id)->get();
    }
}
