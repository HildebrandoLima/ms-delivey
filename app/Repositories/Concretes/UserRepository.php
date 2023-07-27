<?php

namespace App\Repositories\Concretes;

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

    public function create(User $user): int
    {
        return User::query()->create($user->toArray())->orderBy('id', 'desc')->first()->id;
    }

    public function update(User $user): bool
    {
        return User::query()->where('id', '=', $user->id)->update($user->toArray());
    }

    public function getAll(string $search, bool $active): Collection
    {
        $collection = $this->query()
        ->where(function($query) use ($search, $active) {
            if (!empty($search)):
                $query->where('users.name', 'like', $search)->where('users.ativo', '=', $active);
            else:
                $query->where('users.ativo', '=', $active);
            endif;
        })->orderByDesc('users.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = UserMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function getOne(int $id, bool $active): Collection
    {
        $collect = $this->query()->where('users.ativo', '=', $active)
        ->where('users.id', '=', $id)->get()->toArray()[0];
        $collection = UserMapperDto::mapper($collect);
        return collect($collection);
    }

    private function query(): Builder
    {
        return User::with('endereco')->with('telefone');
    }
}
