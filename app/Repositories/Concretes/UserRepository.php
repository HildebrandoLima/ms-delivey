<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\UserDto;
use App\DataTransferObjects\MappersDtos\UserMapperDto;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return User::query()->where('id', '=', $id)->update(['ativo' => $active]);
    }

    public function emailVerifiedAt(int $id, int $active): bool
    {
        return User::query()->where('ativo', '=', $active)->where('id', '=', $id)->update(['email_verified_at' => now()]);
    }

    public function create(UserDto $userDto): User
    {
        return User::query()->create((array)$userDto);
    }

    public function update(int $id, UserDto $userDto): User
    {
        User::query()->where('id', '=', $id)->update((array)$userDto);
        return User::query()->first();
    }

    public function getAll(int $active): Collection
    {
        $collection = $this->mapToQuery()->where('users.ativo', '=', $active)->orderByDesc('users.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = UserMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function getOne(int $id, string $search, int $active): Collection
    {
        $collect = $this->mapToQuery()->where('users.ativo', '=', $active)->where('users.id', '=', $id)
        ->orWhere('users.name', 'like', $search)->get()->toArray()[0];
        $collection = UserMapperDto::mapper($collect);
        return collect($collection);
    }

    private function mapToQuery(): Builder
    {
        return User::with('perfil')->with('endereco')->with('telefone');
    }
}