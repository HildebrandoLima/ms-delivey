<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\MappersDtos\UserMapperDto;
use App\Models\User;
use App\Repositories\Abstracts\EntityRepository;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository implements EntityRepository
{
    public function create(Model $model): int
    {
        return $model::query()->create($model->toArray())->orderBy('id', 'desc')->first()->id;
    }

    public function update(Model $model): bool
    {
        return $model::query()->where('id', '=', $model->id)->update($model->toArray());
    }

    public function readAll(string $search): Collection
    {
        $collection = $this->query()
        ->where(function($query) use ($search) {
            QueryFilter::getQueryFilter($query);
            if (!empty($search)):
                $query->where('users.nome', 'like', $search);
            else:
                QueryFilter::getQueryFilter($query);
            endif;
        })->orderByDesc('users.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = UserMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function readOne(int $id): Collection
    {
        $collection = $this->query()
        ->where(function($query) {
            QueryFilter::getQueryFilter($query);
        })
        ->where('users.id', '=', $id)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = UserMapperDto::mapper($instance);
        endforeach;
        return collect($collection);
    }

    protected function query(): Builder
    {
        return User::with('endereco')->with('telefone');
    }
}
