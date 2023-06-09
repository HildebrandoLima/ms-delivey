<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Support\Utils\Pagination\PaginationList;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserRepository implements IUserRepository {
    public function create(User $user): User
    {
        return User::query()->create($user->toArray());
    }

    public function emailVerifiedAt(int $id, int $active): bool
    {
        return User::query()->where('ativo', $active)->where('id', $id)->update(['email_verified_at' => Carbon::now()]);
    }

    public function update(int $id, User $user): User
    {
        User::query()->where('id', $id)->update($user->toArray());
        return $user->get()[0];
    }

    public function delete(int $id): bool
    {
        return User::query()->where('id', $id)->delete();
    }

    public function getAll(int $active): Collection
    {
        $query = $this->mapToQuery();
        $query->where('ativo', $active)->orderByDesc('id');
        return PaginationList::createFromPagination($query);
    }

    public function getFind(int $id, string $search, int $active): Collection
    {
        return $this->mapToQuery()
        ->where('ativo', $active)
        ->where('id', $id)
        ->orWhere('name', 'like', $search)->get();
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
