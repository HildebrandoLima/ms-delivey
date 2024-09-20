<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListFindByIdUserRepository;
use App\Domains\Dtos\UserDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\User;
use App\Support\Queries\QueryFilter;
use Illuminate\Support\Collection;

class ListFindByIdUserRepository implements IListFindByIdUserRepository
{
    use AutoMapper;

    public function listFindById(int $id, bool $active): Collection
    {
        $collection = $this->query($id, $active);
        foreach ($collection->toArray() as $key => $value) {
            $collection[$key] = $this->mapTo($value, UserDto::class);
        }
        return $collection;
    }

    private function query(int $id, bool $active): Collection
    {
        return User::with('endereco')->with('telefone')
        ->where(function($query) use ($id, $active) {
            QueryFilter::getQueryFilter($query, $active);
        })->where('users.id', $id)->get();
    }
}
