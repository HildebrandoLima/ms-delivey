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

    public function enableDisable(int $id, int $active): bool
    {
        return User::query()->where('id', $id)->update(['ativo' => $active]);
    }

    public function getAll(int $active): Collection
    {
        $query = $this->mapToQuery();
        $query->where('users.ativo', $active)->orderByDesc('users.id');
        return PaginationList::createFromPagination($query);
    }

    public function getFind(int $id, string $search, int $active): Collection
    {
        return $this->mapToQuery()
        ->where('users.ativo', $active)
        ->where('users.id', $id)
        ->orWhere('users.name', 'like', $search)->get();
    }

    private function mapToQuery(): Builder
    {
        return User::with('perfil')->select([
            'users.id as usuarioId',
            'users.provider_id as providerId',
            'users.provider as provider',
            'users.name as nome',
            'users.cpf as cpf',
            'users.email as email',
            'users.data_nascimento as dataNascimento',
            'users.genero as genero',
            'users.email_verified_at as emailVerificado',
            'users.ativo as ativo',
            'users.created_at as criadoEm',
            'users.updated_at as alteradoEm',
        ]);
    }
}
