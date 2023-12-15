<?php

namespace App\Repositories\Concretes;

use App\Dtos\UserDto;
use App\Models\PasswordReset;
use App\Models\User;
use App\Repositories\Abstracts\IUserRepository;
use App\Support\AutoMapper\AutoMapper;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository implements IUserRepository
{
    public function readAll(string $search, bool $filter): Collection
    {
        $collection = User::with('endereco')->with('telefone')
        ->where(function($query) use ($search, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search)):
                $query->where('users.nome', 'like', $search);
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('users.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = User::with('endereco')->with('telefone')
        ->where(function($query) use ($filter) {
            QueryFilter::getQueryFilter($query, $filter);
        })
        ->where('users.id', '=', $id)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    public function readCode(string $codigo): int
    {
        return User::query()
        ->join('password_resets as pr', 'pr.email', '=', 'users.email')
        ->select('users.id')->where('pr.codigo', '=', $codigo)->get()->toArray()[0]['id'];
    }

    public function readSocial(string $email): Model|null
    {
        return User::query()->where('users.email', '=', $email)->first();
    }

    public function delete(string $codigo): bool
    {
        return PasswordReset::query()->where('codigo', '=', $codigo)->delete();
    }

    private function map(array $data): UserDto
    {
        return AutoMapper::map($data, UserDto::class);  
    }
}
