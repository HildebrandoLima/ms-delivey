<?php

namespace App\Data\Repositories\Concretes;

use App\Domains\Dtos\UserDto;
use App\Data\Repositories\Abstracts\IUserRepository;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\User;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginatedList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserRepository implements IUserRepository
{
    use AutoMapper;

    public function hasPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->paginate(10);
        foreach ($collection->items() as $key => $instance):
          $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginatedList::createFromPagination($collection);
    }

    public function noPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = $this->query('', $id, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    private function query(string $search, int $id, bool $filter): Builder
    {
        return User::with('endereco')->with('telefone')
        ->where(function($query) use ($search, $id, $filter) {
            if (!empty($search)):
                $query->where('users.nome', 'like', $search);
            elseif (!empty($id)):
                $query->where('users.id', '=', $id);
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('users.id');
    }

    private function map(array $data): UserDto
    {
        return $this->mapper($data, UserDto::class);  
    }
}
