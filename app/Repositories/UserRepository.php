<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Models\Telefone;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use App\Support\Utils\QueryBuilder\UserQuery;
use Illuminate\Support\Collection;

class UserRepository implements IUserRepository {
    public function insert(User $user): int
    {
        return User::query()->insertGetId([
            'name' => $user->name,
            'cpf' => $user->cpf,
            'email' => $user->email,
            'password' => $user->password,
            'data_nascimento' => $user->data_nascimento,
            'ativo' => $user->ativo,
            'genero' => $user->genero,
            'created_at' => $user->created_at,
        ]);
    }

    public function update(int $id, User $user): bool
    {
        return User::query()->where('id', $id)->update([
            'name' => $user->name,
            'cpf' => $user->cpf,
            'email' => $user->email,
            'password' => $user->password,
            'data_nascimento' => $user->data_nascimento,
            'ativo' => $user->ativo,
            'genero' => $user->genero,
            'updated_at' => $user->updated_at
        ]);
    }

    public function delete(int $id): bool
    {
        $user = User::query()->where('id', $id)->delete();
        $address = Endereco::query()->where('usuario_id', $id)->delete();
        $telephone = Telefone::query()->where('usuario_id', $id)->delete();
        if(!$user and !$address and !$telephone):
            return false;
        endif;
        return true;
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        $resulQuery = new UserQuery();
        $query = $resulQuery->userQuery();
        $query->orderBy('id');
        if (isset ($pagination->page) && isset ($pagination->perPage)):
            return PaginationList::createFromPagination($query, $pagination);
        endif;
        return $query->where('name', 'like', $search)
            ->orWhere('email', 'like', $search)->get();
    }

    public function getFind(int $id): Collection
    {
        $resulQuery = new UserQuery();
        $query = $resulQuery->userQuery();
        $query->where('id', $id);
        return $query->get();
    }
}
