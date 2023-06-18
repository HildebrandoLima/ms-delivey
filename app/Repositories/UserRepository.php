<?php

namespace App\Repositories;

use App\MappersDto\UserMapperDto;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Support\Utils\Pagination\PaginationList;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserRepository implements IUserRepository
{
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
        $collection = $this->mapToQuery()->where('users.ativo', $active)->orderByDesc('users.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = UserMapperDto::map($instance);
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function getFind(int $id, string $search, int $active): Collection
    {
        $collect = $this->mapToQuery()->where('users.ativo', $active)->where('users.id', $id)
        ->orWhere('users.name', 'like', $search)->paginate(1)->items();
        $collection = UserMapperDto::map($collect[0]);
        return collect($collection);
    }

    private function mapToQuery(): Builder
    {
        return User::with('perfil')->with('endereco')->with('telefone');
    }
}
