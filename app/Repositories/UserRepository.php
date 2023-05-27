<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserRepository implements IUserRepository {
    public function insert(User $user): int
    {
        return User::query()->insertGetId($user->toArray());
    }

    public function update(int $id, User $user): bool
    {
        return User::query()->where('id', $id)->update($user->toArray());
    }

    public function delete(int $id): bool
    {
        return User::query()->where('id', $id)->delete();
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        $query = $this->mapToQuery();
        $query->orderByDesc('id');
        if (isset ($pagination->page) && isset ($pagination->perPage)):
            return PaginationList::createFromPagination($query, $pagination);
        endif;
        return $query->where('name', 'like', $search)
            ->orWhere('email', 'like', $search)->get();
    }

    public function getFind(int $id): Collection
    {
        return $this->mapToQuery()->where('id', $id)->get();
    }

    private function mapToQuery(): Builder
    {
        return User::query()->select([
            'id as usuarioId',
            'name as nome',
            'cpf as cpf',
            'email as email',
            'data_nascimento as dataNascimento',
            'genero as genero',
            'ativo as ativo',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
